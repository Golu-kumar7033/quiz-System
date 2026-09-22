
<style>
footer {
  display:flex;
  justify-content:space-between;
  background: #111827;
  color: #fff;
  padding: 30px 20px 20px;
  text-align: center;
  margin-top: 50px;
}

/* Social Icons */
.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
}
.nav-links{
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom:10px;

}
.nav-links a {
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.3s ease;
}
.social-links a {
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #1e293b;
  color: #fff;
  border-radius: 50%;
  font-size: 20px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.social-links a:hover {
  background: #2563eb;
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
}

/* Footer Bottom */
.footer-bottom {
  color: #94a3b8;
  font-size: 14px;
}

/* Mobile */
@media (max-width: 500px) {
  footer {
    padding: 25px 15px 15px;
  }

  .social-links a {
    width: 40px;
    height: 40px;
    font-size: 18px;
  }
}

  </style>

  <footer>

    <div class="social-links">
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-square-linkedin"></i></a>
    </div>

    <div class="footer-bottom">
        <div class="nav-links">
            <a href="{{route('home')}}">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>

        </div>
      © 2026 Quiz-System. All Rights Reserved.
    </div>
 
  </footer>
