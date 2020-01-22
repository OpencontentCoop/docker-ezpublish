# Ez Publish Legacy

![GitHub](https://img.shields.io/github/license/OpencontentCoop/docker-ezpublish)
![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/OpencontentCoop/docker-ezpublish?sort=semver)

Image *opencontentcoop/ezpublish*

![Docker Automated build](https://img.shields.io/docker/cloud/automated/opencontentcoop/ezpublish)
![Docker build status](https://img.shields.io/docker/build/opencontentcoop/ezpublish)
![MicroBadger Layers](https://img.shields.io/microbadger/layers/opencontentcoop/ezpublish)
![MicroBadger Image Size](https://img.shields.io/microbadger/image-size/opencontentcoop/ezpublish)

Image *opencontentcoop/ezpublish-nginx*

![Docker Automated build](https://img.shields.io/docker/cloud/automated/opencontentcoop/ezpublish-nginx)
![Docker build status](https://img.shields.io/docker/build/opencontentcoop/ezpublish-nginx)
![MicroBadger Layers](https://img.shields.io/microbadger/layers/opencontentcoop/ezpublish-nginx)
![MicroBadger Image Size](https://img.shields.io/microbadger/image-size/opencontentcoop/ezpublish-nginx)



This repository is used to create e Docker base-image for projects developed by Opencontent using Ez Publish.

## Tech info

To better understand how we use this repo, please check some project that use it as base-image:

 * [OpenCity](https://gitlab.com/opencontent/opencity)
 * [OpenAgenda](https://gitlab.com/opencontent/openagenda)

Basically we use the base image to install all the OS dependencies of Ez, the next step we add to Dockerfile
is commonly add the _composer.*_ files for the specific project.

## Nginx image

The nginx image is a simple alpine-based nginx with a virtualhost configured for ez publish

The image uses also [nginx-prometheus-exporter](https://github.com/nginxinc/nginx-prometheus-exporter) and expose
nginx metrics in prometheus format on `/metrics` url, check the [official Grafana dashboard](https://github.com/nginxinc/nginx-prometheus-exporter/blob/master/grafana/README.md) to show these metrics
