#!/bin/bash
set -e

# Copy mu-plugins into the volume-mounted path at runtime
mkdir -p /bitnami/wordpress/wp-content/mu-plugins
cp -rf /opt/bitnami/wordpress/wp-content/mu-plugins/. /bitnami/wordpress/wp-content/mu-plugins/
chown -R 1001:1001 /bitnami/wordpress/wp-content/mu-plugins

# Hand off to Bitnami's normal entrypoint
exec /opt/bitnami/scripts/wordpress/entrypoint.sh "$@"
