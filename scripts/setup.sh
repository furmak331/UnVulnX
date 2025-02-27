#!/bin/bash

echo "Starting Exploitohorizon..."

# Stop existing containers (if any)
docker-compose -f docker/docker-compose.yml down -v

# Build and run new containers
docker-compose -f docker/docker-compose.yml up --build -d

echo "Containers are running! Open http://localhost"
chmod +x scripts/setup.sh
