#!/bin/bash
set -e

mkdir -p /bitnami/wordpress/wp-content/mu-plugins
cp -rf /opt/bitnami/wordpress/wp-content/mu-plugins/. /bitnami/wordpress/wp-content/mu-plugins/
chown -R 1001:1001 /bitnami/wordpress/wp-content/mu-plugins 2>/dev/null || true

exec /opt/bitnami/scripts/wordpress/entrypoint.sh "$@"
