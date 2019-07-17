![Hungersoft.com](https://www.hungersoft.com/skin/front/custom/images/logo.png)

# Admin Reindex [M2]
**hs/module-admin-reindex**

Magento 2 does not allow you to reindex from the admin. To reindex when you've set it to update on schedule, you might have to wait for the cron to run or reindex manually using your CLI to run the reindex command.
This could be very frustrating when you just need to run a quick reindex mostly during testing phase.

Hungersoft's Admin Reindex extension allows you to reindex directly from your Magento admin.

## Installation

```sh
composer config repositories.hs-module-all vcs https://github.com/hungersoft/module-all.git
composer config repositories.hs-module-admin-reindex vcs https://github.com/hungersoft/magento2-admin-reindex.git
composer require hs/module-admin-reindex:dev-master

php bin/magento module:enable HS_All HS_AdminReindex
php bin/magento setup:upgrade
```

**Note:** Make sure you've installed our Base extension. The above commands already include it, but if you haven't, you can find it [here](https://github.com/hungersoft/module-all)

## Support

Magento 2 Admin Reindex extension is provided for free by Hungersoft. Feel free to contact Hungersoft at support@hungersoft.com if you are facing any issues with this extension. Reviews, suggestions and feedback will be greatly appreciated.
