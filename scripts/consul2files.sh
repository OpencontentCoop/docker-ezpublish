#!/bin/bash
#
# CONSUL2FILESTREE
#
# Utility to use with command 'consul watch'
#
# Monitors a tree of keys in Consul and write them
# to a local path as configuration tree of files
#


KV_PREFIX=$1
DEST_PREFIX=${2:-/var/www/html/settings}
DEST_UID=${3:-$UID}


# a simple log function in bash
# usage:
#   log "my info message"
#   log "my debug message" debug

log_level=info
# uncomment next line to rise up log level
log_level=debug

log() {
   local msg=$1
   local level=${2:-info}
   if [[ $level == debug ]] && [[ $log_level != debug ]]; then
          return 0
   fi
   now=$(date --rfc-3339=seconds)
   echo "$now [$level] $msg" >> /dev/stderr
}


# check input parameters
if [[ $KV_PREFIX == '' ]]; then
  log "Missing arg #1 KV_PREFIX"
  exit 1
fi

# Check to see if a pipe exists on stdin.
# if not the script is not executed by consul watch command
if [ ! -p /dev/stdin ]; then
  log "No input was found on stdin, skipping! Script must be run from consul watch..."
  exit 2
fi

# on first execution cleanup the $DEST_PREFIX path
if [[ ! -f $DEST_PREFIX/.first_run ]]; then
  log "First time running, cleaning $DEST_PREFIX" debug
  rm -rf $DEST_PREFIX/*
  touch $DEST_PREFIX/.first_run
fi



# get the list of files changed
files=$(cat - | jq -r '.[].Key' |grep -v '/$')

# write each file in the list
# (ignoring if it's updated or not)
for file in $files; do
  content=$(consul kv get $file)
  # remove the prefix from the path: the relative path in consul is the relative path in filesystem
  relative_path=${file#*$KV_PREFIX/}

  # choose the final path in the filesystem
  final_pathname="$DEST_PREFIX/$relative_path"
  
  log "$file -> $final_pathname" debug
  
  # check if all the parent directories exists, or create them if needed
  final_path=$(dirname $final_pathname)
  if [[ ! -d $final_path ]]; then
    log "Creating missing directory '$final_path'" debug
    mkdir --parents $final_path
    # chown $DEST_UID:$DEST_GID $final_path
  fi

  echo $content > $final_pathname

  if [[ ! -f $final_pathname ]]; then
    log "Error, creating file '$final_pathname'"
  else
    # sudo chown $DEST_UID:$DEST_GID $final_pathname
    log "Wrote '$final_pathname'"
  fi
done
