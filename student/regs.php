<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link href="css/reg.css" rel="stylesheet">
</head>
<body>
<form method="post" action="backend/registerbkend.php" autocomplete="off">
<div class="reg-form">
<h1>Sign Up</h1>
<div class="input1">
<input type="text" placeholder="Enter your full name" name="name">
</div>
<div class="input1">
<input type="text" placeholder="Enter your email" name="email">
</div>
<div class="input1">
<input type="password" placeholder="Enter your desired password" name="password">
</div>
<div class="input1">
<input type="text" placeholder="Enter your address" name="address">
</div>
<div class="input1">
<input type="text" placeholder="Enter your contact number" name="contact">
</div>
<div class="input1">
<label>Semester:</label>
<select name="semester">
  <option value="1"   selected>1st semester</option>
  <option value="2" >2nd semester </option>
  <option value="3" >3rd semester</option>
  <option value="4" >4th semester</option>
  <option value="5" >5th semester</option>
  <option value="6" >6th semester</option>
  <option value="7" >7th semester</option>
  <option value="8" >8th semester</option>
</select>
</div>
<div class="input1">
<label>Gender:</label>
<div class="gender">
  <div class="radio-box">
    <label>Male</label>
    <input type="radio" name="gen" value="male" checked>
  </div>
  <div class="radio-box">
    <label>Female</label>
    <input type="radio" name="gen" value="female">
  </div>
</div>
</div>
<div class="input1">
  <button type="submit" class="btn" name="submit">Sign Up</button>
</div>
<div>
  <p>Already have an account? <a href="logins.php" class="signup">Login</a></p>
  </div>
</div>
</form>
</body>
</html>