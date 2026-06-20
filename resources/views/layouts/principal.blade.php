<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gerenciamento de categorias e produtos">
    <title>@yield('titulo', 'Sistema de Produtos')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primario: #6366f1;
            --primario-escuro: #4f46e5;
            --primario-claro: #e0e7ff;
            --secundario: #f59e0b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --texto: #1e293b;
            --texto-suave: #64748b;
            --borda: #e2e8f0;
            --sucesso: #10b981;
            --perigo: #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--texto);
            min-height: 100vh;
        }

        /* ── Navbar ── */
        .navbar-principal {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 60%, #4f46e5 100%);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
            padding: 0.75rem 0;
        }

        .navbar-brand-custom {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff !important;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .navbar-brand-custom .brand-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .nav-link-custom {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: rgba(255,255,255,0.15);
            color: #fff !important;
        }

        /* ── Main ── */
        main {
            padding: 2rem 0;
        }

        /* ── Page Header ── */
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--texto);
            margin: 0;
        }

        .page-header p {
            color: var(--texto-suave);
            margin: 0.25rem 0 0;
            font-size: 0.95rem;
        }

        /* ── Alertas ── */
        .alert-sucesso {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border: 1px solid #6ee7b7;
            border-left: 4px solid var(--sucesso);
            border-radius: 12px;
            color: #065f46;
            padding: 0.9rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease;
        }

        .alert-erro {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 1px solid #fca5a5;
            border-left: 4px solid var(--perigo);
            border-radius: 12px;
            color: #991b1b;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Cards ── */
        .card-custom {
            background: var(--card-bg);
            border: 1px solid var(--borda);
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        /* ── Tabelas ── */
        .table-custom thead th {
            background: #f1f5f9;
            color: var(--texto-suave);
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            padding: 0.85rem 1rem;
        }

        .table-custom tbody td {
            vertical-align: middle;
            border-color: var(--borda);
            padding: 0.85rem 1rem;
            font-size: 0.9rem;
        }

        .table-custom tbody tr:hover {
            background-color: #f8faff;
        }

        /* ── Botões ── */
        .btn-primario {
            background: linear-gradient(135deg, var(--primario), var(--primario-escuro));
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primario:hover {
            background: linear-gradient(135deg, var(--primario-escuro), #3730a3);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99,102,241,0.4);
        }

        .btn-secundario {
            background: var(--bg);
            color: var(--texto-suave);
            border: 1px solid var(--borda);
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-secundario:hover {
            background: #e2e8f0;
            color: var(--texto);
        }

        .btn-editar {
            background: #eff6ff;
            color: #3b82f6;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 0.35rem 0.75rem;
            font-size: 0.82rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-editar:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-excluir {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 0.35rem 0.75rem;
            font-size: 0.82rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-excluir:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ── Formulários ── */
        .form-label-custom {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--texto-suave);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .form-control-custom,
        .form-select-custom {
            border: 1.5px solid var(--borda);
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: var(--primario);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
            outline: none;
        }

        /* ── Badges ── */
        .badge-categoria {
            background: var(--primario-claro);
            color: var(--primario-escuro);
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
        }

        /* ── Imagem produto ── */
        .img-produto-thumb {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--borda);
        }

        .sem-imagem {
            width: 52px;
            height: 52px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 1.4rem;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--texto-suave);
        }

        .empty-state i {
            font-size: 3rem;
            opacity: 0.3;
            margin-bottom: 1rem;
        }

        /* ── Footer ── */
        footer {
            text-align: center;
            padding: 1.5rem 0;
            color: var(--texto-suave);
            font-size: 0.82rem;
            border-top: 1px solid var(--borda);
            margin-top: 3rem;
        }
    </style>
</head>
<body>

    @include('parciais.menu')

    <main class="container">

        @if (session('sucesso'))
            <div class="alert-sucesso" id="alerta-sucesso">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('sucesso') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-erro" id="alerta-erro">
                <strong><i class="bi bi-exclamation-triangle-fill"></i> Verifique os erros abaixo:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('conteudo')
    </main>

    <footer>
        <span>Sistema de Produtos &copy; {{ date('Y') }} — Programação Web 2</span>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-esconder alerta de sucesso após 4 segundos
        setTimeout(() => {
            const alerta = document.getElementById('alerta-sucesso');
            if (alerta) {
                alerta.style.transition = 'opacity 0.5s';
                alerta.style.opacity = '0';
                setTimeout(() => alerta.remove(), 500);
            }
        }, 4000);
    </script>
</body>
</html>
