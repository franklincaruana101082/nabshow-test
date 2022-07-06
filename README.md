# VIP Go Skeleton

Welcome to VIP! This repo is a starting point for building your VIP Go site, including all the base folders to be built on.

## Guidebooks

We'd recommend starting with one of the following guidebooks. They include everything you need to know about launching and developing with VIP:

- [Launching with VIP](https://wpvip.com/documentation/launching-with-vip/)
- [Developing with VIP](https://wpvip.com/documentation/developing-with-vip/)

## Quick links to relevant documentation

To dig straight into our documentation and get up and running, try:

- [Understanding your VIP Go codebase](https://wpvip.com/documentation/vip-go/understanding-your-vip-go-codebase/)
- [VIP Go local development](https://wpvip.com/documentation/vip-go/local-vip-go-development-environment/)

## Usage

All the directories in this repo are required, and will be available on production web servers. Any additional directories created will not be available in production.

## Support

If you need help with anything, VIP's support team is [just a ticket away](https://wpvip.com/documentation/vip-go/accessing-vip-support/).

## Your content here

Feel free to add to or replace this README.md content with content unique to your project, for example:

- Project-specific notes; like a list of VIP environments and branches,
- Workflow documentation; so everyone working in this repo can follow a defined process, or
- Instructions for testing new features.

## Local Development

Once you have [the pre-requisites from this article](https://docs.wpvip.com/how-tos/local-development/use-the-vip-local-development-environment/) set up, do the following:

```bash
vip @nabshow.production dev-env create --slug=nabshow
```

When you run this, you'll be asked a series of questions that you can just hit enter on to accept the defaults:

1. WordPress site title: nabshow
2. Multisite: Y
3. Would you like to redirect to nabshow.com for missing media files? Y
4. Wordpress - Which version would you like? 5.9
5. How would you like to source vip-go-mu-plugins? image
6. How would you like to source site-code? local
   - What is a path to your local site-code? YOUR LOCAL PATH TO THE GIT REPOSITORY

Next, you'll start the environment:

```bash
vip dev-env start --slug=nabshow
```

This take a little while to start up, but once it completes, you can see info about the running environment by running:

```bash
vip dev-env info --slug=nabshow
```

### Database Import

The default installation does not automatically import a database, so you also have to run the following the first time ([docs](https://docs.wpvip.com/technical-references/vip-local-development-environment/#h-import)):

```bash
vip --slug=nabshow dev-env import sql PATH_TO_SQL_SNAPSHOT --search-replace="nabshow.com,nabshow.vipdev.lndo.site"
```

Note: The default snapshot that VIP provides is really big and has table data we don't need in development. Talk to PJ to get a cleaned SQL snapshot that is 1/3 of the normal size and easier to import.

Once the import command is complete, you can access the site using the URL from the above info command.

### Clean Up

When you're done developing for the day, shut down your locally running site:

```bash
vip dev-env stop --slug=nabshow
```

### CSS Workflow

If you are editing CSS:

```bash
npm install
gulp
```
