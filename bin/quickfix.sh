#!/bin/bash
BASE="$HOME/projects/maxsite-cms/public_html"
chmod 777 ${BASE}/application/{cache,logs,uploads,uploads/_mso_float,uploads/_mso_i,uploads/mini}
chmod 777 ${BASE}/application/cache/{db,html,rss}
chmod a+w ${BASE}/sitemap.xml
