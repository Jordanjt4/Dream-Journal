## DreamNote
A cute little dream journal that emphasizes user experience. 

### Features
- User authentication: Login and registration
- Interactive effects: Parallax clouds and sparkly mouse trail
- Background music: Plays Laufey's ["While You Were Sleeping" Piano Version](https://www.youtube.com/watch?v=OfmCCMZIi1Y)
- Users can add, edit, and delete notes

### Built With
- Backend: PHP (hosted locally with XAMPP)
- Frontend: PHP, HTML, CSS
- Database: MySQL (via XAMPP)
- Design: I fully designed with Canva (Cows are Canva's premium elements, everything else is original)

### Installation and Usage

1. Install XAMPP. Ensure Apache and MySQL are both running in the control panel.

2. Put DreamNote into the 'htdocs' directory inside XAMPP.

3. Set up the database.
- Open [phpMyAdmin](http://localhost/phpmyadmin/)
- Create a new database.
- entries: entriesId, usersId, entriesTitle, entriesContent, entriesDate
- users: usersId, usersUid, usersPwd

4. Run the app.
```
http://localhost/DreamNote
```