<html>
<head>
 <title>Firebase Realtimesasasadasdasc Database Web</title>
<script src="https://www.gstatic.com/firebasejs/5.4.2/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAMmt6nbnS3hZe-z1JQsgdsY6T3A23EaVs",
    authDomain: "aigility-88d5a.firebaseapp.com",
    databaseURL: "https://aigility-88d5a.firebaseio.com",
    projectId: "aigility-88d5a",
    storageBucket: "aigility-88d5a.appspot.com",
    messagingSenderId: "593421580466"
  };
  
   
  firebase.initializeApp(config);
</script>
</head>
<body>
 <table>
  <tr>
   <td>Id: </td>
   <td><input type="text" name="id" id="user_id" /></td>
  </tr>
  <tr>
   <td>User Name: </td>
   <td><input type="text" name="user_name" id="user_name" /></td>
  </tr>
  <tr>
   <td colspan="2">
    <input type="button" value="Save" onclick="save_user();" />
    <input type="button" value="Update" onclick="update_user();" />
    <input type="button" value="Delete" onclick="delete_user();" />
   </td>
  </tr>
 </table>
 
 <h3>Users List</h3>
 
 <table id="tbl_users_list" border="1">
  <tr>
   <td>#ID</td>
   <td>NAME</td>
  </tr>
 </table>
 
 <script>
 
  var tblUsers = document.getElementById('tbl_users_list');
  var databaseRef = firebase.database().ref('users/');
  var rowIndex = 1;
  
  databaseRef.once('value', function(snapshot) {
    snapshot.forEach(function(childSnapshot) {
   var childKey = childSnapshot.key;
   var childData = childSnapshot.val();
   
   var row = tblUsers.insertRow(rowIndex);
   var cellId = row.insertCell(0);
   var cellName = row.insertCell(1);
   cellId.appendChild(document.createTextNode(childKey));
   cellName.appendChild(document.createTextNode(childData.user_name));
   
   rowIndex = rowIndex + 1;
    });
  });
   
  function save_user(){
   var user_name = document.getElementById('user_name').value;
  
   var uid = firebase.database().ref().child('users').push().key;
   
   var data = {
    user_id: uid,
    user_name: user_name
   }
   
   var updates = {};
   updates['/users/' + uid] = data;
   firebase.database().ref().update(updates);
   
   alert('The user is created successfully!');
   reload_page();
  }
  
  function update_user(){
   var user_name = document.getElementById('user_name').value;
   var user_id = document.getElementById('user_id').value;

   var data = {
    user_id: user_id,
    user_name: user_name
   }
   
   var updates = {};
   updates['/users/' + user_id] = data;
   firebase.database().ref().update(updates);
   
   alert('The user is updated successfully!');
   
   reload_page();
  }
  
  function delete_user(){
   var user_id = document.getElementById('user_id').value;
  
   firebase.database().ref().child('/users/' + user_id).remove();
   alert('The user is deleted successfully!');
   reload_page();
  }
  
  function reload_page(){
   window.location.reload();
  }
  
 </script>
 
</body>
</html>