#Project Setup (Using Docker)
1. Install vendor packages using command
``docker-compose run --rm php composer install``
2. Start the container using command
``docker-compose up -d``
3. Run the migration using command
``php yii migrate``
  The following migration will be running :
   1. ``m220926_103206_create_user_table``
   2. ``m220926_122855_create_timezone``
   3. ``m220926_122921_create_week_days``
   4. ``m220926_122945_create_appointment``
   5. ``m220927_043928_appointment_booking``
4. Seed the test data using below commands
   1. ``php yii generate/user-data`` => Seed the users data
   2. ``php yii generate/timezone-data`` => Seed the timezone data
   3. ``php yii generate/week-days-data`` => Seed the week days data
   4. ``php yii generate/appointment-data`` => Seed the appointments data

#APIs : 
1. Get List of coaches
``curl --request GET \
--url http://localhost:8000/v1/user``
2. 30 minutes slots available for a particular coach 
``curl --request GET \
  --url http://localhost:8000/v1/appointment/slots \
  --header 'Content-Type: application/json' \
  --header 'user_id: 1'``
3. Create appointment booking 
``curl --request POST \
   --url http://localhost:8000/v1/appointment-booking/create \
   --header 'Content-Type: application/json' \
   --data '{
   "from":"5:00:00",
   "to": "3:00:40",
   "appointment_id": 2
   }'``

#Test Suite Execution : 
Run the below command to run the test suit 
``codecept run api``

#TODO: 
1. Code refactoring 
2. API Documentation 
3. Authentication and Authorization
4. Improve API structure 
5. Improve Performance 
6. API level validation 
7. Docker file to run install composer dependencies when container is initialized 
