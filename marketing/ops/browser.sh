#!/usr/bin/env bash
# Electrik marketing — single persistent bb-browser profile.
# Agent: ALWAYS use this script instead of bare `bb-browser`.
#
# Usage:
#   marketing/ops/browser.sh status
#   marketing/ops/browser.sh open https://github.com/login
#   marketing/ops/browser.sh tab list

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
LAB_ROOT="$(cd "$SCRIPT_DIR/../../.." && pwd)"

export BB_BROWSER_HOME="${BB_BROWSER_HOME:-$LAB_ROOT/.browser/electrik-marketing}"
mkdir -p "$BB_BROWSER_HOME"

if ! command -v bb-browser >/dev/null 2>&1; then
  echo "bb-browser not found. Install: npm install -g bb-browser" >&2
  exit 1
fi

exec bb-browser "$@"
