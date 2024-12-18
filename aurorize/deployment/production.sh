#!/bin/sh

git checkout master_backup
git pull
git merge master
git push
git checkout master
git pull
git merge staging
git push
git checkout feature/chetan