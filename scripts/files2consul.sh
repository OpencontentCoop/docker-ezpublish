#!/bin/bash
#
# FILES2CONSUL
#
# Import a directory and subdirectories to consul
# creating a key for each file containing the content 
# of the file as its value

### COMMODITY FUNCTIONS

# a simple log function in bash
# usage:
#   log "my info message"
#   log "my debug message" debug
log() {
   local msg=$1
   local level=${2:-info}
   if [[ $level == debug ]] && [[ $log_level != debug ]]; then
          return 0
   fi
   now=$(date --rfc-3339=seconds)
   echo "$now [$level] $msg" >> /dev/stderr
}

show_syntax() 
{
  cat <<HERE

  FILES2CONSUL
 
  Import a directory and subdirectories to consul
  creating a key for each file containing the content 
  of the file as its value
 
  Syntax:
 
   files2consul -k <PREFIX> [-p PATH] [-v] 
 
    -k PREFIX: 	prefix keys in Consul
    -p PATH:    local path to search for files (default: .)
    -v: 	verbose
    -y:		don't ask for confirmation (unattended run)

HERE
}

error() {
  msg=$1
  echo 
  log "$msg" error
  show_syntax
  exit 1
}

### ARGUMENT PARSING

log_level=info
consul_prefix=''
local_path='.'
unattended=false
while getopts 'abf:v' flag; do
  case "${flag}" in
    k) consul_prefix="${OPTARG}" ;;
    p) local_path="${OPTARG}" ;;
    v) log_level='debug' ;;
    y) unattended=true ;;
    *) error "Unexpected option ${flag}" ;;
  esac
done

[[ $consul_prefix == '' ]] && error "Missing argument 'consul prefix'"


### MAIN SCRIPT

files_list=$(find $local_path -type f)
files_count=$(echo $files | wc -w)

if [[ $unattended == false ]]; then
  echo "Importing ${files_count} files to Consul under path ${consul_prefix}"
  echo "Press any key to continue, CTRL+C to stop here..."
  read nothing
fi

for file in $files_list; do
  relative_path=${file#*${local_path}/}
  dest_key="${consul_prefix}/${relative_path}"
  consul kv put $dest_key @${file}
  log "Loaded $file in $dest_key"
done

log "Finished successfully." debug
