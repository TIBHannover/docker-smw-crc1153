#!/usr/bin/env bash
set -euo pipefail

REF_KEYS="$1"
ALT_JSON="$2"
NEU_JSON="$3"

jq -Rn \
  --slurpfile alt "$ALT_JSON" \
  --slurpfile neu "$NEU_JSON" \
  '
  # read ref keys from stdin into array
  [inputs | select(length>0)] as $keys
  |
  reduce $keys[] as $k (
    {
      changed: {},
      unchanged: {},
      missing_in_alt: [],
      missing_in_neu: []
    };

    if ($alt[0] | has($k)) and ($neu[0] | has($k)) then
      if ($alt[0][$k] == $neu[0][$k]) then
        .unchanged[$k] = $alt[0][$k]
      else
        .changed[$k] = {
          alt: $alt[0][$k],
          neu: $neu[0][$k]
        }
      end
    elif ($alt[0] | has($k)) and ( ($neu[0] | has($k)) | not ) then
      .missing_in_neu += [$k]
    elif ( ($alt[0] | has($k)) | not ) and ($neu[0] | has($k)) then
      .missing_in_alt += [$k]
    else
      .
    end
  )
  ' < "$REF_KEYS"
