@extends("welcome")
@section("content")
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      #header {
        background-color: while;
        color: #000;
        text-align: center;
        padding: 20px;
      }
      #profile {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
      }
      img {
        max-width: 100%;
        height: auto;
      }
      h1 {
        margin-top: 0;
      }
      p {
        line-height: 1.5;
      }
    </style>
    <div id="header">
      <h1>PROFILE</h1>
    </div>
    <div id="profile">
        
        <div class="avatar-frame1">
            <img src="path/to/avatar-image" alt="Avatar">
        </div>

      <h2>Tên khách hàng</h2>
      <p>Email: example@gmail.com</p>
      <p>Số điện thoại: 0123456789</p>
      <p>Địa chỉ: 123 đường ABC, Quận XYZ, Thành phố HCM</p>
    </div>
    @endsection