<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Themed Login</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  *{box-sizing:border-box;margin:0;padding:0;font-family:"Nunito",sans-serif}
  body{
    height:100vh; display:flex; align-items:center; justify-content:center;
    background: linear-gradient(135deg,#3b82f6,#60a5fa);
    transition: background 1.2s ease;
    overflow:hidden; position:relative;
  }
  .page-bg{
    position:absolute; inset:0; z-index:0;
    background-size:cover; background-position:center;
    opacity:0.4;
    transition: opacity 0.8s ease, background-image 0.8s ease-in-out;
  }
  .card{
    position:relative; z-index:2; width:880px; display:flex; border-radius:16px; overflow:hidden;
    box-shadow: 0 18px 40px rgba(12,20,40,0.18); background:#fff;
  }
  .left {
    flex:1; min-width:320px; padding:36px 28px; color:#fff; display:flex; flex-direction:column;
    justify-content:center; align-items:flex-start; gap:10px; position:relative;
    transition: background 1s ease;
  }
  .left h1{ font-size:30px; margin-bottom:6px; line-height:1.05; font-weight:700 }
  .left p.lead{ font-size:16px; opacity:0.95; margin-bottom:6px }
  .left p.small{ font-size:14px; opacity:0.9 }
  .left .building-vec{
    position:absolute; right:-30px; bottom:-10px; opacity:0.08; width:340px; height:220px; pointer-events:none;
  }

  .right {
    flex:1; padding:36px 40px; display:flex; flex-direction:column;
    justify-content:center; align-items:stretch; gap:14px;
  }
  .form-title{ font-size:22px; font-weight:700; color:#222; margin-bottom:4px; text-align:left }
  .form-sub{ font-size:13px; color:#555; margin-bottom:14px; text-align:left }

  form { display:flex; flex-direction:column; gap:18px; }
  input[type="text"], input[type="password"], select {
    width:100%; padding:12px 14px; border-radius:10px; border:1px solid #ddd; font-size:15px;
    transition: box-shadow .18s ease, border-color .18s ease;
  }
  input:focus, select:focus {
    outline:none; border-color: rgba(34, 124, 255, .95);
    box-shadow:0 6px 18px rgba(34,124,255,0.06);
  }

  .btn {
    padding:12px 14px; border-radius:10px; border:none; cursor:pointer; color:#fff;
    font-weight:600; font-size:15px;
    transition: transform .12s ease, box-shadow .12s ease, background .5s ease;
    box-shadow: 0 8px 22px rgba(16,24,64,0.08);
  }
  .btn:active{ transform:translateY(1px) }

  .muted{ font-size:13px; color:#666; margin-top:8px; text-align:center }
  #message { text-align:center; font-size:14px; margin-top:8px; }

  @media (max-width:820px) {
    .card{ width:94%; flex-direction:column }
    .left{ align-items:center; text-align:center }
    .right{ padding:24px }
  }
</style>
</head>
<body>
  <div id="pageBg" class="page-bg"></div>

  <div class="card" id="card">
    <div class="left" id="leftPanel">
      <h1 id="welcomeTitle">Welcome Back!</h1>
      <p class="lead" id="welcomeSubtitle">Select your company to get started</p>
      <p class="small" id="welcomeHint" style="margin-top:18px"></p>

      <svg class="building-vec" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <g fill="#fff">
          <rect x="40" y="230" width="80" height="200" rx="6" />
          <rect x="140" y="190" width="100" height="240" rx="6" />
          <rect x="260" y="140" width="120" height="290" rx="6" />
          <rect x="400" y="200" width="90" height="230" rx="6" />
          <rect x="510" y="150" width="140" height="280" rx="6" />
          <rect x="680" y="210" width="60" height="220" rx="6" />
        </g>
      </svg>
    </div>

    <div class="right">
      <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div style="display:flex; flex-direction:column; gap:6px;">
          <div class="form-title">Sign in</div>
          <div class="form-sub">Enter your account credentials to continue</div>
        </div>

        <input id="username" name="username" type="text" placeholder="Username" value="{{ old('username') }}" />
        <input id="password" name="password" type="password" placeholder="Password" />
        <select id="companySelect" name="company_id" onchange="onCompanyChange()">
          <option value="">Select company</option>
          <option value="1" {{ old('company_id') == 1 ? 'selected' : '' }}>TechNova Solutions</option>
          <option value="2" {{ old('company_id') == 2 ? 'selected' : '' }}>Green Leaf Solutions</option>
        </select>

        @if ($errors->has('login_error'))
          <p id="message" style="color:red;">{{ $errors->first('login_error') }}</p>
          <script>
            setTimeout(()=>document.getElementById('message').style.display='none', 5000);
          </script>
        @endif

        <button id="loginBtn" type="submit" class="btn" style="margin-top:12px; background: linear-gradient(135deg,#2563eb,#60a5fa);">
          Login
        </button>
      </form>

      <div class="muted">Don't have an account? Contact your administrator.</div>
    </div>
  </div>

<script>
  const left = document.getElementById('leftPanel');
  const pageBg = document.getElementById('pageBg');
  const welcomeTitle = document.getElementById('welcomeTitle');
  const welcomeSubtitle = document.getElementById('welcomeSubtitle');
  const welcomeHint = document.getElementById('welcomeHint');
  const loginBtn = document.getElementById('loginBtn');

  function setDefaultTheme(){
    document.body.style.background = "linear-gradient(135deg,#3b82f6,#60a5fa)";
    left.style.background = "linear-gradient(135deg,#2563eb,#60a5fa)";
    loginBtn.style.background = "linear-gradient(135deg,#2563eb,#60a5fa)";
    fadeBackground("https://images.unsplash.com/photo-1508780709619-79562169bc64?auto=format&fit=crop&w=1600&q=80", 0.35);
    welcomeTitle.textContent = "Welcome Back!";
    welcomeSubtitle.textContent = "Select your company to get started";
    welcomeHint.textContent = "";
  }

  function setTechNova(){
    document.body.style.background = "linear-gradient(135deg,#7e22ce,#fde047)";
    left.style.background = "linear-gradient(135deg,#9333ea,#facc15)";
    loginBtn.style.background = "linear-gradient(135deg,#7e22ce,#fde047)";
    fadeBackground("https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80", 0.5);
    welcomeTitle.textContent = "Glad to see you!";
    welcomeSubtitle.textContent = "Good to see you again.";
    welcomeHint.textContent = "Enter your username and password to get started.";
  }

  function setGreenLeaf(){
    document.body.style.background = "linear-gradient(135deg,#15803d,#a16207)";
    left.style.background = "linear-gradient(135deg,#16a34a,#78350f)";
    loginBtn.style.background = "linear-gradient(135deg,#16a34a,#a16207)";
    fadeBackground("https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1600&q=80", 0.6);
    welcomeTitle.textContent = "Hey there!";
    welcomeSubtitle.textContent = "Let's grow something great 🌱";
    welcomeHint.textContent = "Enter your username and password to get started.";
  }

  // Helper for smooth background switch
  function fadeBackground(url, opacity=0.4){
    pageBg.style.opacity = "0";
    setTimeout(()=>{
      pageBg.style.backgroundImage = `url('${url}')`;
      pageBg.style.opacity = opacity;
    }, 400);
  }

  function onCompanyChange(){
    const v = document.getElementById('companySelect').value;
    if(!v) setDefaultTheme();
    else if(v === '1') setTechNova();
    else if(v === '2') setGreenLeaf();
  }

  // Initialize default
  setDefaultTheme();
</script>
</body>
</html>
