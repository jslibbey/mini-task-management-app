
# Mini Task Management Application
## How to Setup
- Version:

    Make sure you've already set up later php and node versions than the following.
    ```bash
     Laravel v11.8.0 - PHP 8.2.0
     Vue v3.4.27 - Node v18.18.0
    ```

- Copy the `.env.example` to `.env` file and configure the database and mailer settings

- Install packages

    ```bash
     composer install
     npm install

     php artisan migrate
     php artisan db:seed --class=UserSeeder

    ```

- Run server
    ```bash
     php artisan serve
     npm run dev
    ```

- to clear cache
    ```bash
     php artisan config:cache
     php artisan cache:clear
    ```

- How to run the Queue worker and the scheduler
    ```bash
     php artisan schedule:run
     php artisan queue:work
    ```



## A brief explanation of the design
- user login/signup

    Users can log in or sign up using their email and password. There is no email verification or similar processes implemented because it's just a test.
    
- Default account: The default account credentials are as follows:
    ```bash
    admin@example.com / password
    ```

- Create, Delete, Edit, View Task

    The functionality is similar to Jira:
  - To create a new task, click the `Create task` button on the task list page.
  - Clicking the `edit` button allows you to update the status of the task.
  - Click the `delete` button to remove a task.
  - Clicking on the task name in the task table enables you to view the task details.
  - Subtasks can be created on a task details page by clicking the `Create subtask` button.
