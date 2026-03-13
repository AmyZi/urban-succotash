#!/bin/bash
mkdir -p /bitnami/wordpress/wp-content/mu-plugins 2>/dev/null || true
cp -rf /opt/bitnami/wordpress/wp-content/mu-plugins/. /bitnami/wordpress/wp-content/mu-plugins/ 2>/dev/null || true
