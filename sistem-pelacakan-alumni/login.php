<!DOCTYPE html>
<html>

<head>
<title>Login</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>

.info-box{
display:none;
margin-top:10px;
padding:10px;
background:#f2f8ff;
border:1px solid #cfe6ff;
border-radius:6px;
font-size:14px;
}

.info-icon{
cursor:pointer;
font-size:18px;
margin-left:5px;
color:#1BA0E2;
}

/* tombol login ditengah */
.button{
display:block;
margin:15px auto;
}

</style>

</head>

<body>

<div class="login-page">

<div class="card login-card">

<div class="title">
Login Admin 
<span class="info-icon" onclick="toggleInfo()">ℹ️</span>
</div>

<form method="POST" action="proses_login.php">

<div class="form-group">
<label>Username</label>
<input type="text" name="username">
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password">
</div>

<button class="button" type="submit">Login</button>

</form>

<div class="info-box" id="infoLogin">
Untuk uji coba sistem gunakan akun berikut:<br>
<b>Username:</b> admin <br>
<b>Password:</b> admin
</div>

</div>

</div>

<script>

function toggleInfo(){

var info = document.getElementById("infoLogin");

if(info.style.display === "block"){
info.style.display = "none";
}else{
info.style.display = "block";
}

}

</script>

</body>
</html>