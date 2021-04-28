<h1>About Favorite Company App</h1>
<br/>
<p>Favorite company is a website-based application that serves to create a list of companies you like. Where you can easily add and remove companies from your favorites list.
This website was created using Laravel and VueJs
</p>
<br/>
<p>Before you duplicate the app, there are a few conditions that must be met first. <br/>Here are the conditions that must be met.</p>
<ul>
  <li>Install PHP version >= 7.4</li>
  <li>Install Database Management System MySQL</li>
  <li>Install Composer</li>
  <li>Install Node Js</li>
  <li>Install NPM</li>
</ul>
<p>For how to install the terms in you can search for them on google.</p>
<p>If above now, you clone the repository. Once the repository is complete and successfully cloned, then the steps below.</p>
<ol>
  <li>Create a database on MySQL.</li>
  <li>Set the connection in the .env file, enter the username, password and database name you have created in the first. </li>
  <li>
    Step 3 open the terminal or gitbash or command prompt and navigate to the directory where you cloned it, after that type the following command.
    <br/>
    <code>composer install</code>
    <br/>
    The above command is used to download the laravel framework library already registered to the application.
    <br/>
    <code>npm install</code>
    <br/>
    The above command is used to download the vue js framework library already registered to the application.
    <br/>
    <code>php artisan db:seed --class CompanySeeder</code>
    <br/>
    The above command is used to import company data into the company table in the database you have created.
    <br/>
    <code>php artisan migrate</code>
    <br/>
    The above command is used to import the table into the database you have created.
  </li>
  <li>
    If all in step 3 has been done and succeeded then the command types below.
    <br/>
    <code>php artisan serve</code>
    <br/>
    the above command is used to serve the laravel framework's website
  </li>
  <li>Next step open a new terminal or gitbash or command prompt to set up the command below.
    <br/>
    <code>npm run watch</code>
  </li>
  <li>Done already steps are done to run the company's favorite web-based applications</li>
</ol>
<p>Thank you for visiting hopefully it can be useful for you all.</p>
