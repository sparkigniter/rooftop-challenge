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

Screen Snaps : 
1. Migration: 
<img width="1440" alt="Screenshot 2022-09-27 at 11 58 42 AM" src="https://user-images.githubusercontent.com/11609189/192454298-a527cada-7871-4ed9-b217-d432c78ea080.png">
2. Data Seeding:
<img width="1440" alt="Screenshot 2022-09-27 at 12 00 23 PM" src="https://user-images.githubusercontent.com/11609189/192454400-693654cb-0df4-4967-b538-046cc8f4e195.png">
3. API Results : 
Get users (coaches) 
<img width="1440" alt="Screenshot 2022-09-27 at 12 24 34 PM" src="https://user-images.githubusercontent.com/11609189/192454584-9b39bf1c-ca99-4fb3-8498-4acf9a7bb38a.png">
30 minutes slots available for a particular coach 
<img width="1440" alt="Screenshot 2022-09-27 at 12 25 20 PM" src="https://user-images.githubusercontent.com/11609189/192454821-28bd1c6a-bfac-4681-84e9-03e92398fba2.png">
create appointment slot booking 
<img width="1440" alt="Screenshot 2022-09-27 at 12 26 04 PM" src="https://user-images.githubusercontent.com/11609189/192454940-a5226773-7161-428a-94f6-aae240d3ab35.png">
