<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $company->name ?? 'Dashboard' }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary: {{ $company->primary_color ?? '#7c3aed' }};
      --accent: {{ $company->accent_color ?? '#facc15' }};
    }

    body {
      font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:#f4f6fb;
    }

    /* SIDEBAR */
    .sidebar {
      width: 260px;
      min-height: 100vh;
      background: linear-gradient(180deg, var(--primary), color-mix(in srgb, var(--primary) 60%, #000 20%));
      color: #fff;
      padding: 20px;
      position: fixed;
      left: 0;
      top: 0;
      overflow-y: auto;
      z-index: 100;
    }

    .sidebar .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 25px;
      padding: 10px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.08);
    }

    .sidebar .logo img {
      width: 48px;
      height: 48px;
      object-fit: contain;
      border-radius: 8px;
      background-color: #fff;
      border: 1px solid rgba(255,255,255,0.1);
      padding: 4px;
    }

    .nav-link {
      color: rgba(255,255,255,.9);
      border-radius:10px;
      padding:10px 12px;
      margin:6px 0;
      display:flex;
      align-items:center;
      justify-content: space-between;
      gap:10px;
      transition: all 0.2s ease;
    }

    .nav-link.active, .nav-link:hover {
      background: rgba(255,255,255,0.12);
      color:#fff;
      text-decoration:none;
    }

    .submenu { padding-left: 25px; display: none; }
    .submenu.show { display: block; }

    /* CONTENT */
    .content {
      margin-left: 280px;
      padding: 32px;
    }

    .topbar {
      display:flex;
      align-items:center;
      justify-content:space-between;
      flex-wrap:wrap;
      gap:12px;
      margin-bottom:20px;
    }

    .brand-pill { background: var(--accent); color: #111; padding:4px 10px; border-radius:999px; font-weight:700; font-size:12px; }

    .position-label {
      font-weight: 600;
      color: var(--primary);
    }

    /* DASHBOARD CARDS */
    .card-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card-stats .card {
      border: none;
      border-radius: 14px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      text-align: center;
      padding: 30px 10px;
      background: #fff;
      transition: transform 0.2s ease;
    }

    .card-stats .card:hover { transform: translateY(-4px); }
    .card-stats h3 { font-size: 2rem; color: var(--primary); margin-bottom: 5px; }

    /* HERO + INFO */
    .hero-section {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      margin-top: 30px;
    }

    .hero-content { padding: 50px; }
    .hero-content h2 { font-size: 2.5rem; font-weight: 700; color: #111; }
    .hero-content p { color: #555; line-height: 1.7; }

    /* WHY TECHNOVA */
    .why-section {
      margin-top: 60px;
    }
    .why-section h3 {
      font-weight: 700;
      color: var(--primary);
      text-align: center;
      margin-bottom: 30px;
    }
    .why-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .why-card {
      background: #fff;
      border-radius: 16px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: all 0.2s ease;
    }
    .why-card:hover { transform: translateY(-5px); }
    .why-card i {
      font-size: 2.2rem;
      color: var(--primary);
      margin-bottom: 12px;
    }
    .why-card h5 { font-weight: 600; margin-bottom: 8px; color: #222; }
    .why-card p { color: #666; font-size: 0.95rem; }

    /* INFO SECTION (Greenleaf) */
    .info-section {
      margin-top: 50px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }
    .info-card {
      background: #fff;
      border-radius: 16px;
      padding: 32px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.2s ease;
    }
    .info-card:hover { transform: translateY(-5px); }
    .info-card i { font-size: 2rem; color: var(--primary); margin-bottom: 12px; }

    @media (max-width: 900px) {
      .sidebar { width:100%; position:relative; min-height:auto; }
      .content { margin-left:0; padding:18px; }
      .hero-content { padding: 24px; }
    }
  </style>

  <script>
    function toggleSubmenu(id) {
      document.getElementById(id).classList.toggle('show');
    }
  </script>
</head>
<body>

  <div class="sidebar d-flex flex-column">
    <div class="logo">
      @php
        $logos = [
          1 => 'logos/technova_logo.png',
          2 => 'logos/greenleaf_logo.png'
        ];
        $logoPath = asset($logos[$company->id] ?? 'logos/default_logo.png');
      @endphp

      <img src="{{ $logoPath }}" alt="{{ $company->name ?? 'Logo' }}">
      <div>
        <h5 class="mb-0 fw-bold">{{ $company->name ?? 'Company' }}</h5>
        <small>{{ $company->code ?? '' }}</small>
      </div>
    </div>

    <nav class="nav flex-column w-100 mt-3">
      <a href="#" class="nav-link active"><div><i class="bi bi-house-door-fill"></i> Home</div></a>

      @if($company->id == 1)
      <!-- TECHNOVA MENU -->
      <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('cat1')">
        <div><i class="bi bi-list-ul"></i> Categories</div><i class="bi bi-chevron-down small"></i>
      </a>
      <div id="cat1" class="submenu">
        <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('product1')">
          <div><i class="bi bi-box-seam"></i> Product</div><i class="bi bi-chevron-down small"></i>
        </a>
        <div id="product1" class="submenu">
          <a href="#" class="nav-link"><i class="bi bi-basket"></i> Local</a>
          <a href="#" class="nav-link"><i class="bi bi-globe"></i> International</a>
        </div>
        <a href="#" class="nav-link"><i class="bi bi-people-fill"></i> Staff</a>
        <a href="#" class="nav-link"><i class="bi bi-cash-stack"></i> Finance</a>
        <a href="#" class="nav-link"><i class="bi bi-journal-text"></i> Logs</a>
      </div>
      <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('set1')">
        <div><i class="bi bi-gear-fill"></i> Settings</div><i class="bi bi-chevron-down small"></i>
      </a>
      <div id="set1" class="submenu">
        <a href="#" class="nav-link"><i class="bi bi-sliders"></i> System Config</a>
        <a href="#" class="nav-link"><i class="bi bi-person-check"></i> Access Control</a>
      </div>

      @elseif($company->id == 2)
      <!-- GREENLEAF MENU -->
      <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('cat2')">
        <div><i class="bi bi-list-ul"></i> Categories</div><i class="bi bi-chevron-down small"></i>
      </a>
      <div id="cat2" class="submenu">
        <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('prog2')">
          <div><i class="bi bi-diagram-3"></i> Programs</div><i class="bi bi-chevron-down small"></i>
        </a>
        <div id="prog2" class="submenu">
          <a href="#" class="nav-link"><i class="bi bi-sun"></i> Sustainability Projects</a>
          <a href="#" class="nav-link"><i class="bi bi-globe2"></i> Environmental Campaigns</a>
        </div>

        <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('teams2')">
          <div><i class="bi bi-people-fill"></i> Teams</div><i class="bi bi-chevron-down small"></i>
        </a>
        <div id="teams2" class="submenu">
          <a href="#" class="nav-link"><i class="bi bi-person-badge"></i> Field Staff</a>
          <a href="#" class="nav-link"><i class="bi bi-person-lines-fill"></i> Volunteers</a>
        </div>

        <a href="#" class="nav-link"><i class="bi bi-clipboard-data"></i> Reports</a>
        <a href="#" class="nav-link"><i class="bi bi-info-circle"></i> About</a>
      </div>

      <a href="javascript:void(0)" class="nav-link" onclick="toggleSubmenu('set2')">
        <div><i class="bi bi-gear-fill"></i> Settings</div><i class="bi bi-chevron-down small"></i>
      </a>
      <div id="set2" class="submenu">
        <a href="#" class="nav-link"><i class="bi bi-sliders"></i> System Config</a>
        <a href="#" class="nav-link"><i class="bi bi-person-check"></i> Access Control</a>
      </div>
      @endif
    </nav>

    <div class="mt-auto w-100">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-light w-100" type="submit">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>

  <div class="content">
    <div class="topbar">
      <div>
        <h3 class="mb-0">Welcome, {{ $user->username ?? 'User' }}</h3>
        <div class="text-muted">
          You are inside <span class="brand-pill">{{ $company->name ?? 'Company' }}</span><br>
          <small>Company Position: 
            <span class="position-label">
              @if($company->id == 1)
                Staff
              @elseif($company->id == 2)
                Admin
              @else
                Member
              @endif
            </span>
          </small>
        </div>
      </div>
      <div class="text-muted small">Company ID: <strong>{{ $user->company_id ?? '-' }}</strong></div>
    </div>

    {{-- Conditional Content --}}
    @if($company->id == 1)
      <!-- TECHNOVA DASHBOARD -->
      <div class="card-stats">
        <div class="card"><h3>741</h3><p class="text-muted mb-0">Products</p></div>
        <div class="card"><h3>123</h3><p class="text-muted mb-0">Orders</p></div>
        <div class="card"><h3>56</h3><p class="text-muted mb-0">BioChips</p></div>
        <div class="card"><h3>12</h3><p class="text-muted mb-0">Refunds</p></div>
      </div>

      <div class="hero-section mt-4">
        <div class="row g-0 align-items-center">
          <div class="col-md-6 hero-content">
            <img src="{{ asset('logos/technova_logo.png') }}" width="100" class="mb-3">
            <h2>The Professional BioChip</h2>
            <p class="fw-semibold text-secondary">Faster biological reactions designed for precision and innovation.</p>
            <p class="text-muted">A biochip is a miniaturized laboratory performing rapid biological analysis — decoding genes, diagnosing diseases, and tracking health data.</p>
          </div>
          <div class="col-md-6">
            <img src="{{ asset('logos/biochip.png') }}" class="w-100 h-100 object-fit-cover" alt="Biochip">
          </div>
        </div>
      </div>

      <div class="why-section">
        <h3>Why Choose Technova?</h3>
        <div class="why-grid">
          <div class="why-card">
            <i class="bi bi-cpu-fill"></i>
            <h5>Cutting-Edge Innovation</h5>
            <p>We continuously push the limits of biotech hardware, developing faster and smarter laboratory tools for the modern world.</p>
          </div>
          <div class="why-card">
            <i class="bi bi-shield-check"></i>
            <h5>Unmatched Precision</h5>
            <p>Our products are designed with meticulous care to ensure accuracy in diagnostics, research, and real-time biological data tracking.</p>
          </div>
          <div class="why-card">
            <i class="bi bi-globe2"></i>
            <h5>Global Impact</h5>
            <p>Technova partners with institutions worldwide to advance healthcare and environmental biotechnology for a sustainable future.</p>
          </div>
        </div>
      </div>

    @elseif($company->id == 2)
      <!-- GREENLEAF DASHBOARD -->
      <div class="hero-section mt-3">
        <div class="row g-0 align-items-center">
          <div class="col-md-6 hero-content">
            <img src="{{ asset('logos/greenleaf_logo.png') }}" width="100" class="mb-3">
            <h2>A Revolution in Energy as a Service</h2>
            <p class="fw-semibold text-secondary">Innovating sustainable solutions for a greener future.</p>
            <p class="text-muted">Greenleaf leads in eco-friendly energy systems and environmental services — merging technology and sustainability for a better planet.</p>
          </div>
          <div class="col-md-6">
            <img src="{{ asset('logos/Environmental.png') }}" class="w-100 h-100 object-fit-cover" alt="Environment">
          </div>
        </div>
      </div>

      <div class="info-section">
        <div class="info-card">
          <i class="bi bi-lightbulb"></i>
          <h4>Our Mission</h4>
          <p>To drive environmental transformation through renewable energy solutions that empower communities.</p>
        </div>
        <div class="info-card">
          <i class="bi bi-eye"></i>
          <h4>Our Vision</h4>
          <p>To be a leading catalyst for sustainable living where technology and nature coexist harmoniously.</p>
        </div>
        <div class="info-card">
          <i class="bi bi-tree-fill"></i>
          <h4>Our Programs</h4>
          <p>From solar projects to reforestation, Greenleaf fosters innovation and care for the environment.</p>
        </div>
      </div>
    @endif
  </div>
</body>
</html>
