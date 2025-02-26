#!/bin/bash


echo "### Docker composer start ###"
cd /vagrant

docker compose --env-file .env.dev.local -f compose.yaml -p controlehoras up -d --renew-anon-volumes --remove-orphans --force-recreate --build