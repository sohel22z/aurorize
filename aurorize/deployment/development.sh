#!/bin/sh

git checkout feature/development
git pull
git merge feature/chetan
git push
git checkout feature/chetan