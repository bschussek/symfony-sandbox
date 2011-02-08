#!/bin/sh

# initialization
DIR=`php -r "echo realpath(dirname(\\$_SERVER['argv'][0]));"`

if [ -d "$DIR/vendor" ]; then
  rm -rf $DIR/vendor/*
else
  mkdir $DIR/vendor
fi

VENDOR=$DIR/vendor
cd $VENDOR

# Symfony
git clone git://github.com/fabpot/symfony.git symfony

# Doctrine ORM
git clone git://github.com/doctrine/doctrine2.git doctrine
cd doctrine
git reset --hard 2.0.1
cd $VENDOR

# Doctrine DBAL
git clone git://github.com/doctrine/dbal.git doctrine-dbal
cd doctrine-dbal
git reset --hard 2.0.1
cd $VENDOR

# Doctrine Common
git clone git://github.com/doctrine/common.git doctrine-common
cd doctrine-common
git reset --hard 2.0.1
cd $VENDOR

# Doctrine migrations
git clone git://github.com/doctrine/migrations.git doctrine-migrations

# Doctrine data fixtures
git clone git://github.com/doctrine/data-fixtures.git doctrine-data-fixtures

# Doctrine MongoDB
git clone git://github.com/doctrine/mongodb.git doctrine-mongodb
git clone git://github.com/doctrine/mongodb-odm.git doctrine-mongodb-odm

# Swiftmailer
git clone git://github.com/swiftmailer/swiftmailer.git swiftmailer
cd swiftmailer
git reset --hard origin/4.1
cd $VENDOR

# Twig
git clone git://github.com/fabpot/Twig.git twig

# Twig Extensions
git clone git://github.com/fabpot/Twig-extensions.git twig-extensions

# Zend Framework
git clone git://github.com/zendframework/zf2.git zend
cd zend
git submodule update --recursive --init
cd $VENDOR
