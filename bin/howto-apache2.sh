#!/bin/bash
## Check path before starting
sudo ln -s /home/rb/projects/maxsite-cms/config_sets/dev-localhost-rb-Linux/apache2.conf /etc/apache2/conf.d/maxsite-cms.conf
sudo apache2ctl restart
