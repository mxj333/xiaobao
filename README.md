# cms Install Stup

1、

composer create-project --prefer-dist cakephp/app cms

composer require friendsofcake/crud:^4.3

composer require friendsofcake/crud-view

composer require friendsofcake/search

composer require friendsofcake/authenticate:dev-cake3

composer require friendsofcake/crud-users

composer require josegonzalez/cakephp-upload


bin/cake plugin load Crud

bin/cake plugin load CrudView

bin/cake plugin load BootstrapUI

bin/cake plugin load Search

bin/cake plugin load CrudUsers

bin/cake plugin load FOC/Authenticate

bin/cake plugin load Josegonzalez/Upload



2、
bin/cake bake model Users

bin/cake bake controller Users -t Crud

bin/cake bake template Users


3、


bin/cake bake model Articles

bin/cake bake controller Articles -t Crud

4、

