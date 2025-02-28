#!/bin/bash

echo "=== Exploitohorizon Setup ==="
echo "Setting up development environment..."

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "Error: Docker is not installed. Please install Docker first."
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "Error: Docker Compose is not installed. Please install Docker Compose first."
    exit 1
fi

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating default .env file..."
    cat > .env << EOL
DB_ROOT_PASSWORD=root
DB_NAME=dvwa
DB_USER=dvwa
DB_PASSWORD=dvwapassword
EOL
    echo "Default .env file created. Edit it to customize your settings."
fi

# Stop existing containers (if any)
echo "Stopping any existing containers..."
docker-compose -f docker/docker-compose.yml down -v

# Build and run new containers
echo "Building and starting containers..."
docker-compose -f docker/docker-compose.yml up --build -d

# Check if containers are running
if [ $? -eq 0 ]; then
    echo "=== Setup Complete ==="
    echo "Exploitohorizon is now running!"
    echo "Access the dashboard at: http://localhost:8080"
    echo "MySQL database is available at localhost:3307"
    echo ""
    echo "Use the following commands:"
    echo "  - To stop: ./scripts/stop.sh"
    echo "  - To restart: ./scripts/restart.sh"
    echo "  - To view logs: ./scripts/logs.sh"
else
    echo "Error: Failed to start containers. Check docker-compose logs for details."
    exit 1
fi