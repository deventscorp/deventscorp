<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D' Events Catering - Cotizador Personalizado</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --accent: #c5a059;
            --accent-hover: #b08c46;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body.night-mode {
            --primary: #020617;
            --primary-light: #0f172a;
            --bg: #0b0f19;
            --card-bg: #111827;
            --text: #f1f5f9;
            --text-muted: #94a3b8;
            --border: #1e293b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        header {
            background: rgba(15, 23, 42, 0.95);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(197, 160, 89, 0.2);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo span { color: var(--accent); }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
            align-items: center;
        }

        .nav-menu a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-menu a:hover { color: var(--accent); }

        .ambient-toggle {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .ambient-toggle:hover { background: var(--accent-hover); }

        .btn-galeria {
            background: transparent;
            color: #fff;
            border: 1px solid var(--accent);
            padding: 7px 14px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }
        .btn-galeria:hover {
            background: var(--accent);
            color: #fff;
        }

        .hero-slider {
            position: relative;
            height: 60vh;
            min-height: 400px;
            overflow: hidden;
            margin-bottom: 40px;
            margin-top: 60px;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out, transform 1.2s ease-in-out;
            transform: scale(1.05);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85));
            transition: background 0.5s ease;
        }

        body.night-mode .slide-overlay {
            background: linear-gradient(rgba(2, 6, 23, 0.88), rgba(2, 6, 23, 0.95));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            padding: 0 20px;
            max-width: 800px;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 15px;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .hero-content p {
            font-size: 1.1rem;
            max-width: 650px;
            margin: 0 auto 25px;
            color: #e2e8f0;
            font-weight: 300;
        }

        .btn-hero {
            background: var(--accent);
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
            display: inline-block;
        }

        .btn-hero:hover { background: var(--accent-hover); }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 3;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background 0.3s, width 0.3s;
        }

        .dot.active {
            background: var(--accent);
            width: 28px;
            border-radius: 6px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2.2fr 1fr;
            gap: 30px;
            padding: 0 20px 50px;
        }

        .card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            border: 1px solid var(--border);
            transition: background-color 0.4s ease, border-color 0.4s ease;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--bg);
            padding-bottom: 12px;
        }

        body.night-mode .section-title { color: #f8fafc; }
        .section-title i { color: var(--accent); }

        .reverse-calc-box {
            background: rgba(197, 160, 89, 0.08);
            border: 1px dashed var(--accent);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .reverse-calc-box h3 {
            font-size: 1rem;
            color: var(--accent);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reverse-calc-inputs {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .reverse-calc-inputs input {
            flex: 1;
            min-width: 180px;
        }

        .btn-budget {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-budget:hover { background: var(--accent-hover); }

        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 15px;
        }

        .location-card {
            border: 2px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.25s ease;
            background: var(--card-bg);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .location-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: 0 10px 20px rgba(0,0,0,0.06);
        }

        .location-card.selected {
            border-color: var(--accent);
            background-color: rgba(197, 160, 89, 0.05);
        }

        .location-card.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent);
            color: #fff;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .location-img-container {
            width: 100%;
            height: 130px;
            background: #e2e8f0;
        }

        .location-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .location-info {
            padding: 15px;
            text-align: center;
        }

        .location-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            color: var(--primary);
            margin-bottom: 4px;
        }
        body.night-mode .location-info h3 { color: #f8fafc; }

        .location-info p {
            color: var(--accent);
            font-weight: 600;
            font-size: 0.9rem;
        }

        #customLocationBox {
            display: none;
            margin-top: 15px;
            animation: fadeIn 0.3s ease;
        }

        .space-designer-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
            background: rgba(0,0,0,0.03);
            padding: 12px;
            border-radius: 8px;
        }

        .btn-element {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        body.night-mode .btn-element { color: #f8fafc; }

        .btn-element:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .canvas-container {
            width: 100%;
            height: 320px;
            border: 2px dashed var(--accent);
            background: var(--card-bg);
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
            transition: background 0.4s ease;
        }

        body.night-mode .canvas-container {
            background-image: radial-gradient(#334155 1px, transparent 1px);
            box-shadow: inset 0 0 50px rgba(197, 160, 89, 0.15);
        }

        .designer-item {
            position: absolute;
            cursor: move;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: box-shadow 0.2s, filter 0.3s ease;
            text-align: center;
            padding: 4px;
        }

        body.night-mode .designer-item { filter: drop-shadow(0 0 8px rgba(255,255,255,0.4)); }
        .designer-item:hover { box-shadow: 0 6px 15px rgba(0,0,0,0.25); }
        .designer-item.mesa { background: #3b82f6; border-radius: 50%; width: 55px; height: 55px; }
        .designer-item.pista { background: #ec4899; border-radius: 8px; width: 110px; height: 80px; }
        .designer-item.escenario { background: #8b5cf6; border-radius: 6px; width: 120px; height: 50px; }
        .designer-item.bar { background: #10b981; border-radius: 6px; width: 80px; height: 40px; }

        .designer-item .remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ef4444;
            color: #fff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            cursor: pointer;
        }
        .designer-item:hover .remove-btn { display: flex; }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .service-item {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--card-bg);
        }

        .service-item:hover {
            border-color: var(--accent);
            background: rgba(197, 160, 89, 0.05);
        }

        .service-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .service-text strong {
            display: block;
            font-size: 0.9rem;
            color: var(--primary);
        }
        body.night-mode .service-text strong { color: #f8fafc; }

        .service-text span {
            font-size: 0.8rem;
            color: var(--accent);
            font-weight: 600;
        }

        .service-preview-box {
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(197, 160, 89, 0.08);
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid var(--accent);
        }
        .service-preview-box img {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .timeline-item-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        .timeline-item-row input[type="time"] {
            width: 130px;
        }

        .pairing-card {
            margin-top: 15px;
            background: rgba(197, 160, 89, 0.1);
            border: 1px solid var(--accent);
            border-radius: 8px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85rem;
            color: var(--primary);
            animation: fadeIn 0.3s ease;
        }
        body.night-mode .pairing-card { color: #f8fafc; }
        .pairing-card i { font-size: 1.3rem; color: var(--accent); }

        .menu-builder {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 15px;
        }

        .menu-category {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 15px;
            background: var(--card-bg);
        }

        .menu-category h3 {
            font-size: 0.95rem;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        body.night-mode .menu-category h3 { color: #f8fafc; }

        .menu-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }

        .menu-option-card {
            border: 1px solid var(--border);
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }
        .menu-option-card:hover { border-color: var(--accent); background: rgba(197, 160, 89, 0.05); }

        .menu-option-card input[type="radio"] {
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
        }

        .menu-option-info h4 { font-size: 0.85rem; color: var(--primary); }
        body.night-mode .menu-option-info h4 { color: #f8fafc; }
        .menu-option-info p { font-size: 0.75rem; color: var(--accent); font-weight: 600; }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--primary);
        }
        body.night-mode label { color: #f8fafc; }

        input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="number"], select, textarea, input[type="time"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.92rem;
            color: var(--text);
            background-color: var(--card-bg);
            transition: border-color 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15);
        }

        .status-badge {
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 0.82rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-weight: 600;
        }

        .urgency-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fffbe3;
            color: #b45309;
            border: 1px solid #fde047;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-top: 10px;
            animation: fadeIn 0.3s ease;
        }
        body.night-mode .urgency-badge {
            background: #451a03;
            color: #fde047;
            border-color: #78350f;
        }

        .sidebar .card {
            position: sticky;
            top: 90px;
        }

        .summary-details p {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            padding: 10px 0;
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .summary-details p strong, .summary-details p span:last-child {
            font-weight: 600;
            color: var(--primary);
        }
        body.night-mode .summary-details p strong, 
        body.night-mode .summary-details p span:last-child {
            color: #f8fafc;
        }

        .total-price {
            border-bottom: none !important;
            padding-top: 18px !important;
            margin-top: 10px;
        }

        .total-price span:first-child {
            font-size: 1.1rem;
            font-weight: 700 !important;
            color: var(--primary) !important;
        }
        body.night-mode .total-price span:first-child { color: #f8fafc !important; }

        .total-price span:last-child {
            font-size: 1.5rem;
            color: var(--accent) !important;
            font-weight: 700 !important;
        }

        .btn-confirm {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.1s;
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-confirm:hover { background: var(--accent); }

        .btn-action-print {
            width: 100%;
            background: #334155;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.3s;
        }
        .btn-action-print:hover { background: #1e293b; }

        .btn-action-wsp {
            width: 100%;
            background: #25d366;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.3s;
        }
        .btn-action-wsp:hover { background: #1eb956; }

        .modal-galeria {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.85);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }
        .modal-galeria.active { display: flex; }
        .modal-content {
            background: var(--card-bg);
            border-radius: 16px;
            max-width: 800px;
            width: 90%;
            padding: 25px;
            position: relative;
        }
        .galeria-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .galeria-viewer {
            position: relative;
            width: 100%;
            height: 400px;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .galeria-viewer img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .galeria-btn-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.6);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background 0.3s;
        }
        .galeria-btn-nav:hover { background: var(--accent); }
        .galeria-btn-prev { left: 15px; }
        .galeria-btn-next { right: 15px; }

        @media print {
            header, .hero-slider, .sidebar button, .chat-toggle, .chat-widget, .ambient-toggle, .btn-galeria, .no-print, .space-designer-toolbar, .modal-galeria {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .container {
                display: block !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                page-break-inside: avoid;
            }
            .sidebar {
                margin-top: 30px;
            }
        }

        .chat-toggle {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: var(--accent);
            color: white;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            z-index: 1000;
            font-size: 1.3rem;
            transition: transform 0.2s;
        }
        .chat-toggle:hover { transform: scale(1.08); }

        .chat-widget {
            position: fixed;
            bottom: 90px;
            right: 25px;
            width: 330px;
            max-width: 90vw;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 1000;
            border: 1px solid var(--border);
        }
        .chat-header {
            background: var(--primary);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Playfair Display', serif;
        }
        .chat-box {
            height: 280px;
            padding: 15px;
            overflow-y: auto;
            background: var(--bg);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chat-bubble {
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 0.85rem;
            max-width: 82%;
            line-height: 1.4;
        }
        .chat-bubble.user {
            background: var(--primary);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 2px;
        }
        .chat-bubble.bot {
            background: #e2e8f0;
            color: #0f172a;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
        }
        .chat-input {
            display: flex;
            border-top: 1px solid var(--border);
            padding: 8px;
            background: var(--card-bg);
        }
        .chat-input input {
            border: none;
            padding: 8px 12px;
            font-size: 0.88rem;
        }
        .chat-input button {
            background: var(--accent);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2rem; }
            .nav-menu { display: none; }
            .sidebar .card { position: static; }
        }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <a href="#" class="logo">
        <img src="tu-logo.png" alt="Logo" style="height: 42px; width: auto; border-radius: 6px; object-fit: contain; background: #fff; padding: 2px;">
        D' Events <span>Catering</span>
         </a>
        <ul class="nav-menu">
            <li><a href="#locaciones">Locaciones</a></li>
            <li><a href="#espacio">Diseñador de Espacio</a></li>
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="#cronograma">Cronograma</a></li>
            <li><a href="#menu">Gastronomía</a></li>
            <li><a href="#reserva">Reserva</a></li>
            <li>
                <button class="btn-galeria" onclick="toggleGaleria(true)"><i class="fas fa-camera"></i> Fotos</button>
            </li>
            <li>
                <button class="ambient-toggle" onclick="toggleAmbiente()"><i class="fas fa-moon" id="ambientIcon"></i> <span id="ambientText">Vista Noche</span></button>
            </li>
        </ul>
    </div>
</header>

<section class="hero-slider">
    <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="hero-content">
            <h1>Diseña tu Evento Soñado</h1>
            <p>Personaliza cada detalle: desde locaciones exclusivas y distribución de espacios, hasta gastronomía de alto nivel.</p>
            <a href="#locaciones" class="btn-hero"><i class="fas fa-sliders-h"></i> Comenzar a Cotizar</a>
        </div>
    </div>
    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="hero-content">
            <h1>Gastronomía de Autor</h1>
            <p>Elige plato por plato tu menú personalizado y sorprende a todos tus invitados.</p>
            <a href="#menu" class="btn-hero"><i class="fas fa-utensils"></i> Armar Menú</a>
        </div>
    </div>
    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="hero-content">
            <h1>Planificación Interactiva 2D</h1>
            <p>Organiza la distribución de tu pista, mesas y escenario en tiempo real.</p>
            <a href="#espacio" class="btn-hero"><i class="fas fa-drafting-compass"></i> Diseñar Plano</a>
        </div>
    </div>
    <div class="slider-dots">
        <div class="dot active" onclick="setSlide(0)"></div>
        <div class="dot" onclick="setSlide(1)"></div>
        <div class="dot" onclick="setSlide(2)"></div>
    </div>
</section>

<div class="container">
    <div class="main-content">
        
        <!-- 1. LOCACIÓN -->
        <div class="card" id="locaciones">
            <h2 class="section-title"><i class="fas fa-map-marker-alt"></i> 1. Selecciona o Propón tu Locación</h2>
            
            <div class="reverse-calc-box">
                <h3><i class="fas fa-calculator"></i> Cotiza según tu Presupuesto Objetivo</h3>
                <p style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 10px;">Ingresa el monto máximo que deseas invertir:</p>
                <div class="reverse-calc-inputs">
                    <input type="number" id="target_budget" placeholder="Ej. $3,000 USD" step="100">
                    <button class="btn-budget" onclick="optimizarPorPresupuesto()"><i class="fas fa-magic"></i> Optimizar Evento</button>
                </div>
            </div>

            <div class="locations-grid">
                <div class="location-card selected" onclick="seleccionarLocacion(this, 'Quinta Campestre La Sofía', 600, false)">
                    <div class="location-img-container">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=600&q=80" alt="Quinta">
                    </div>
                    <div class="location-info">
                        <h3>Quinta La Sofía</h3>
                        <p>$600.00</p>
                    </div>
                </div>

                <div class="location-card" onclick="seleccionarLocacion(this, 'Salón Premier Miraflores', 1200, false)">
                    <div class="location-img-container">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=600&q=80" alt="Salón">
                    </div>
                    <div class="location-info">
                        <h3>Salón Premier</h3>
                        <p>$1,200.00</p>
                    </div>
                </div>

                <div class="location-card" onclick="seleccionarLocacion(this, 'Hacienda San José', 950, false)">
                    <div class="location-img-container">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80" alt="Hacienda">
                    </div>
                    <div class="location-info">
                        <h3>Hacienda San José</h3>
                        <p>$950.00</p>
                    </div>
                </div>

                <div class="location-card" onclick="seleccionarLocacion(this, 'Mi Propia Locación', 0, true)">
                    <div class="location-img-container" style="display:flex; align-items:center; justify-content:center; background:#1e293b; color:#c5a059;">
                        <i class="fas fa-home fa-3x"></i>
                    </div>
                    <div class="location-info">
                        <h3>Mi Propia Locación</h3>
                        <p>Sin Costo Adicional</p>
                    </div>
                </div>
            </div>

            <div id="customLocationBox" class="form-group">
                <label for="custom_location_address">Dirección o Detalles de tu Locación:</label>
                <input type="text" id="custom_location_address" placeholder="Ej. Av. Interoceánica Km 10, Quinta Particular">
            </div>
        </div>

        <!-- 2. PLANO 2D -->
        <div class="card" id="espacio">
            <h2 class="section-title"><i class="fas fa-drafting-compass"></i> 2. Diseñador del Espacio (Layout Interactivo 2D)</h2>
            <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:12px;">Agrega elementos a tu plano y arrástralos:</p>
            
            <div class="space-designer-toolbar">
                <button class="btn-element" onclick="agregarElemento('mesa')"><i class="fas fa-circle"></i> + Mesa (10 pers)</button>
                <button class="btn-element" onclick="agregarElemento('pista')"><i class="fas fa-music"></i> + Pista de Baile</button>
                <button class="btn-element" onclick="agregarElemento('escenario')"><i class="fas fa-microphone"></i> + Escenario</button>
                <button class="btn-element" onclick="agregarElemento('bar')"><i class="fas fa-glass-martini-alt"></i> + Barra Cocteles</button>
                <button class="btn-element" style="margin-left:auto; color:#ef4444;" onclick="limpiarPlano()"><i class="fas fa-trash"></i> Limpiar Plano</button>
            </div>

            <div class="canvas-container" id="spaceCanvas"></div>
        </div>

        <!-- 3. SERVICIOS -->
        <div class="card" id="servicios">
            <h2 class="section-title"><i class="fas fa-concierge-bell"></i> 3. Armar Servicios Requeridos</h2>
            <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:15px;">Selecciona los servicios que necesitas:</p>
            <div class="services-grid">
                <label class="service-item">
                    <input type="checkbox" id="srv_mc" value="150" onchange="calcularCotizacion(); actualizarVistaServicio('Maestro de Ceremonia', 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=300&q=80', this.checked)">
                    <div class="service-text">
                        <strong>Maestro de Ceremonia</strong>
                        <span>+$150.00</span>
                    </div>
                </label>

                <label class="service-item">
                    <input type="checkbox" id="srv_meseros" value="120" onchange="calcularCotizacion(); actualizarVistaServicio('Equipo de Meseros', 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=300&q=80', this.checked)">
                    <div class="service-text">
                        <strong>Equipo de Meseros</strong>
                        <span>+$120.00</span>
                    </div>
                </label>

                <label class="service-item">
                    <input type="checkbox" id="srv_dj" value="300" onchange="calcularCotizacion(); actualizarVistaServicio('DJ & Iluminación Pro', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=300&q=80', this.checked)">
                    <div class="service-text">
                        <strong>DJ & Iluminación</strong>
                        <span>+$300.00</span>
                    </div>
                </label>

                <label class="service-item">
                    <input type="checkbox" id="srv_decoracion" value="450" onchange="calcularCotizacion(); actualizarVistaServicio('Decoración Temática', 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=300&q=80', this.checked)">
                    <div class="service-text">
                        <strong>Decoración Temática</strong>
                        <span>+$450.00</span>
                    </div>
                </label>

                <label class="service-item">
                    <input type="checkbox" id="srv_foto" value="250" onchange="calcularCotizacion(); actualizarVistaServicio('Fotografía y Video HD', 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=300&q=80', this.checked)">
                    <div class="service-text">
                        <strong>Fotografía y Video</strong>
                        <span>+$250.00</span>
                    </div>
                </label>
            </div>

            <div class="service-preview-box" id="servicePreviewBox" style="display: none;">
                <img id="servicePreviewImg" src="" alt="Vista Previa">
                <div>
                    <h4 id="servicePreviewTitle" style="font-size:0.9rem; color:var(--primary);">Servicio</h4>
                    <p style="font-size:0.78rem; color:var(--text-muted);">Visualización en vivo del montaje real.</p>
                </div>
            </div>
        </div>

        <!-- CRONOGRAMA -->
        <div class="card" id="cronograma">
            <h2 class="section-title"><i class="fas fa-calendar-alt"></i> Cronograma del Evento (Timeline)</h2>
            <div style="display:flex; gap:10px; margin-bottom:15px;" class="no-print">
                <button type="button" onclick="cargarTimelineSugerido()" class="btn-budget">✨ Cargar Sugerencia</button>
                <button type="button" onclick="agregarFilaTimeline()" class="btn-element">➕ Agregar Momento</button>
            </div>
            <div id="timelineContainer"></div>
        </div>

        <!-- 4. GASTRONOMÍA -->
        <div class="card" id="menu">
            <h2 class="section-title"><i class="fas fa-utensils"></i> 4. Personaliza tu Menú Plato a Plato</h2>
            
            <div class="form-group">
                <label for="invitados">Número de Invitados:</label>
                <input type="number" id="invitados" value="50" min="10" onchange="calcularCotizacion()">
            </div>

            <div class="form-group">
                <label for="tiempos_comida">Tiempos de Comida:</label>
                <select id="tiempos_comida" onchange="calcularCotizacion()">
                    <option value="1">1 Tiempo (Plato Fuerte)</option>
                    <option value="2" selected>2 Tiempos (Entrada + Plato Fuerte)</option>
                    <option value="3">3 Tiempos (Entrada + Fuerte + Postre)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_menu">Estilo de Menú Base:</label>
                <select id="tipo_menu" onchange="calcularCotizacion()">
                    <option value="gourmet">Gourmet Internacional</option>
                    <option value="tradicional">Buffet Tradicional</option>
                    <option value="fusión">Cocina de Fusión</option>
                    <option value="vegetariano">Opción Vegetariana / Vegana</option>
                </select>
            </div>

            <div class="menu-builder">
                <div class="menu-category" id="cat_entrada">
                    <h3><i class="fas fa-leaf"></i> Selección de Entrada</h3>
                    <div class="menu-options">
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_entrada" value="Crema de Champiñones con Trufa" data-precio="5" checked onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Crema de Champiñones</h4>
                                <p>+$5.00 / pers</p>
                            </div>
                        </label>
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_entrada" value="Ceviche Gourmet de Camarón" data-precio="7" onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Ceviche Gourmet</h4>
                                <p>+$7.00 / pers</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="menu-category">
                    <h3><i class="fas fa-drumstick-bite"></i> Selección de Plato Fuerte</h3>
                    <div class="menu-options">
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_fuerte" value="Lomo Fino en Salsa de Vino Tinto" data-precio="16" checked onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Lomo Fino al Vino Tinto</h4>
                                <p>+$16.00 / pers</p>
                            </div>
                        </label>
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_fuerte" value="Salmón Glaseado con Maracuyá" data-precio="18" onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Salmón Glaseado</h4>
                                <p>+$18.00 / pers</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="menu-category" id="cat_postre">
                    <h3><i class="fas fa-cookie-bite"></i> Selección de Postre</h3>
                    <div class="menu-options">
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_postre" value="Volcán de Chocolate con Helado" data-precio="4" checked onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Volcán de Chocolate</h4>
                                <p>+$4.00 / pers</p>
                            </div>
                        </label>
                        <label class="menu-option-card">
                            <input type="radio" name="platillo_postre" value="Cheesecake de Frutos Rojos" data-precio="4" onchange="calcularCotizacion(); actualizarMaridaje();">
                            <div class="menu-option-info">
                                <h4>Cheesecake Frutos Rojos</h4>
                                <p>+$4.00 / pers</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pairing-card" id="pairingCard">
                <i class="fas fa-wine-glass-alt"></i>
                <div>
                    <strong>Sugerencia Sommelier:</strong>
                    <span id="pairingText">Cabernet Sauvignon Reserva Especial recomendado para el Lomo Fino.</span>
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label class="checkbox-label" style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                    <input type="checkbox" id="barra_libre" onchange="calcularCotizacion()" style="width:18px; height:18px; accent-color:var(--accent);">
                    Incluir Barra Libre de Cocteles (+$10 por invitado)
                </label>
            </div>
        </div>

        <!-- 5. DATOS DE CONTACTO -->
        <div class="card" id="reserva">
            <h2 class="section-title"><i class="fas fa-user-check"></i> 5. Datos para la Reserva</h2>
            <div class="form-group">
                <label for="fecha_evento">Fecha del Evento:</label>
                <input type="date" id="fecha_evento" onchange="verificarFecha()">
                <div id="statusFecha" class="status-badge">Verificando disponibilidad...</div>
                <div class="urgency-badge" id="urgencyBadge">
                    <i class="fas fa-fire"></i> <span>Alta demanda: Bloqueo garantizado por 24 horas.</span>
                </div>
            </div>

            <div class="form-group">
                <label for="nombre_cliente">Nombre Completo:</label>
                <input type="text" id="nombre_cliente" placeholder="Ej. Carlos Mendoza">
            </div>

            <div class="form-group">
                <label for="celular_cliente">Número de Celular / WhatsApp:</label>
                <input type="tel" id="celular_cliente" name="celular_cliente" placeholder="Ej. 0991234567">
            </div>

            <div class="form-group">
                <label for="email_cliente">Correo Electrónico:</label>
                <input type="email" id="email_cliente" placeholder="carlos@ejemplo.com">
            </div>
        </div>

    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="card" id="pdfSummaryCard">
            <h2 style="font-family:'Playfair Display', serif; color:var(--primary); font-size:1.3rem; margin-bottom:15px;">Resumen</h2>
            <div class="summary-details">
                <p><span>ID Cotización:</span> <strong id="resId">-</strong></p>
                <p><span>Locación:</span> <span id="resLocacion">Quinta Campestre La Sofía</span></p>
                <p><span>Costo Locación:</span> <span id="resCostoLocacion">$600.00</span></p>
                <p><span>Elementos Plano:</span> <span id="resElementos">2 ítems</span></p>
                <p><span>Servicios A la Carta:</span> <span id="resServicios">$0.00</span></p>
                <p><span>Fecha:</span> <span id="resFechaText">-</span></p>
                <p><span>Invitados:</span> <span id="resInvitados">50 personas</span></p>
                <p><span>Menú Selección:</span> <span id="resPlatosSel" style="font-size:0.75rem; text-align:right;">-</span></p>
                <p><span>Subtotal Comida:</span> <span id="resComida">$0.00</span></p>
                <p><span>Barra Libre:</span> <span id="resBarra">$0.00</span></p>
                <p class="total-price"><span>Total Estimado:</span> <span id="resTotal">$0.00</span></p>
            </div>
            <button class="btn-confirm" onclick="confirmarReserva()"><i class="fas fa-calendar-check"></i> Solicitar Reserva</button>
            <button class="btn-action-print" onclick="window.print()"><i class="fas fa-print"></i> Imprimir Todo (Con Diseño)</button>
            <button class="btn-action-wsp" onclick="enviarWhatsAppDirecto()"><i class="fab fa-whatsapp"></i> Reservar en WhatsApp</button>
        </div>
    </div>
</div>

<div class="modal-galeria" id="modalGaleria">
    <div class="modal-content">
        <div class="galeria-header">
            <h3 style="font-family:'Playfair Display', serif;">📸 Galería de Eventos</h3>
            <button onclick="toggleGaleria(false)" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button>
        </div>
        <div class="galeria-viewer">
            <button class="galeria-btn-nav galeria-btn-prev" onclick="cambiarFotoModal(-1)">&#10094;</button>
            <img id="imgGaleriaModal" src="" alt="Foto Evento">
            <button class="galeria-btn-nav galeria-btn-next" onclick="cambiarFotoModal(1)">&#10095;</button>
        </div>
        <p style="text-align:center; margin-top:10px; font-size:0.85rem; color:var(--text-muted);" id="contadorGaleria">Foto 1 de 200</p>
    </div>
</div>

<div class="chat-toggle" onclick="toggleChat()"><i class="fas fa-comments"></i></div>
<div class="chat-widget" id="chat-widget">
    <div class="chat-header">
        <span>Asistente Virtual</span>
        <i class="fas fa-times" onclick="toggleChat()" style="cursor:pointer;"></i>
    </div>
    <div class="chat-box" id="chat-box">
        <div class="chat-bubble bot">¡Hola! ¿En qué puedo ayudarte hoy?</div>
    </div>
    <div class="chat-input">
        <input type="text" id="chatInput" placeholder="Escribe..." onkeypress="if(event.key==='Enter') enviarMensajeChat()">
        <button onclick="enviarMensajeChat()"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
    let locacionNombre = "Quinta Campestre La Sofía";
    let locacionPrecio = 600;
    let esLocacionPropia = false;

    const TOTAL_FOTOS = 200; 
    let fotoActualIndex = 1;

    function toggleGaleria(mostrar) {
        const modal = document.getElementById('modalGaleria');
        if(mostrar) {
            modal.classList.add('active');
            cargarFotoModal(fotoActualIndex);
        } else {
            modal.classList.remove('active');
        }
    }

    function cargarFotoModal(index) {
        document.getElementById('imgGaleriaModal').src = `fotos/foto${index}.jpg`;
        document.getElementById('contadorGaleria').innerText = `Foto ${index} de ${TOTAL_FOTOS}`;
    }

    function cambiarFotoModal(direccion) {
        fotoActualIndex += direccion;
        if(fotoActualIndex > TOTAL_FOTOS) fotoActualIndex = 1;
        if(fotoActualIndex < 1) fotoActualIndex = TOTAL_FOTOS;
        cargarFotoModal(fotoActualIndex);
    }

    function toggleAmbiente() {
        document.body.classList.toggle('night-mode');
        const isNight = document.body.classList.contains('night-mode');
        document.getElementById('ambientIcon').className = isNight ? 'fas fa-sun' : 'fas fa-moon';
        document.getElementById('ambientText').innerText = isNight ? 'Vista Día' : 'Vista Noche';
    }

    function actualizarVistaServicio(titulo, imgUrl, checked) {
        const box = document.getElementById('servicePreviewBox');
        if(checked) {
            document.getElementById('servicePreviewImg').src = imgUrl;
            document.getElementById('servicePreviewTitle').innerText = titulo;
            box.style.display = 'flex';
        } else {
            box.style.display = 'none';
        }
    }

    function optimizarPorPresupuesto() {
        const budget = parseFloat(document.getElementById('target_budget').value);
        if(!budget || budget < 500) {
            alert('Ingresa un presupuesto válido.');
            return;
        }

        if(budget >= 2500) {
            document.getElementById('invitados').value = 100;
            document.getElementById('srv_dj').checked = true;
            document.getElementById('srv_decoracion').checked = true;
            document.getElementById('barra_libre').checked = true;
        } else {
            document.getElementById('invitados').value = 40;
            document.getElementById('srv_dj').checked = true;
            document.getElementById('srv_decoracion').checked = false;
            document.getElementById('barra_libre').checked = false;
        }

        calcularCotizacion();
    }

    function actualizarMaridaje() {
        const fuerteSel = document.querySelector('input[name="platillo_fuerte"]:checked');
        const textElem = document.getElementById('pairingText');
        
        if (fuerteSel && fuerteSel.value.includes('Lomo')) {
            textElem.innerText = "Cabernet Sauvignon Reserva Especial recomendado para el Lomo Fino.";
        } else {
            textElem.innerText = "Chardonnay Frutado sugerido para el Salmón.";
        }
    }

    function enviarWhatsAppDirecto() {
        const nombre = document.getElementById('nombre_cliente').value.trim() || 'Cliente';
        const celular = document.getElementById('celular_cliente').value.trim() || 'No especificado';
        const total = document.getElementById('resTotal').innerText;
        const fecha = document.getElementById('fecha_evento').value;
        const numeroTelefono = '593993938370'; 

        const mensaje = `Hola *D' Events Catering*, deseo confirmar mi evento:%0A%0A` +
                        `👤 *Cliente:* ${nombre}%0A` +
                        `📱 *Celular:* ${celular}%0A` +
                        `📍 *Locación:* ${locacionNombre}%0A` +
                        `📅 *Fecha:* ${fecha}%0A` +
                        `💰 *Total Estimado:* ${total}`;

        window.open(`https://wa.me/${numeroTelefono}?text=${mensaje}`, '_blank');
    }

    // SLIDER HERO
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function setSlide(index) {
        if(slides.length === 0) return;
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    setInterval(() => {
        if(slides.length > 0) {
            let next = (currentSlide + 1) % slides.length;
            setSlide(next);
        }
    }, 4000);

    // PLANO 2D
    const canvas = document.getElementById('spaceCanvas');
    let contadorElementos = 0;

    function agregarElemento(tipo) {
        contadorElementos++;
        const item = document.createElement('div');
        item.className = `designer-item ${tipo}`;
        item.id = `elem_${contadorElementos}`;
        
        let texto = tipo.toUpperCase();
        if(tipo === 'mesa') texto = 'Mesa 10p';
        
        item.innerHTML = `<span>${texto}</span><div class="remove-btn" onclick="eliminarElemento('${item.id}', event)">✕</div>`;
        item.style.left = '20px';
        item.style.top = '20px';
        
        hacerArrastrable(item);
        canvas.appendChild(item);
        actualizarInfoPlano();
    }

    function eliminarElemento(id, e) {
        e.stopPropagation();
        const el = document.getElementById(id);
        if(el) el.remove();
        actualizarInfoPlano();
    }

    function limpiarPlano() {
        canvas.innerHTML = '';
        actualizarInfoPlano();
    }

    function hacerArrastrable(element) {
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        element.onmousedown = dragMouseDown;

        function dragMouseDown(e) {
            if (e.target.classList.contains('remove-btn')) return;
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            element.style.top = (element.offsetTop - pos2) + "px";
            element.style.left = (element.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    function actualizarInfoPlano() {
        const totalElem = canvas.querySelectorAll('.designer-item').length;
        document.getElementById('resElementos').innerText = totalElem + ' ítems';
    }

    function toggleChat() {
        const widget = document.getElementById('chat-widget');
        widget.style.display = (widget.style.display === 'flex') ? 'none' : 'flex';
    }

    function seleccionarLocacion(element, nombre, precio, esPropia) {
        document.querySelectorAll('.location-card').forEach(card => card.classList.remove('selected'));
        element.classList.add('selected');
        locacionNombre = nombre;
        locacionPrecio = precio;
        esLocacionPropia = esPropia;

        document.getElementById('customLocationBox').style.display = esPropia ? 'block' : 'none';
        document.getElementById('resLocacion').innerText = esPropia ? "Mi Propia Locación" : nombre;
        document.getElementById('resCostoLocacion').innerText = '$' + precio.toFixed(2);
        
        verificarFecha();
        calcularCotizacion();
    }

    function obtenerCostoServiciosExtra() {
        let totalServicios = 0;
        ['srv_mc', 'srv_meseros', 'srv_dj', 'srv_decoracion', 'srv_foto'].forEach(id => {
            const el = document.getElementById(id);
            if (el && el.checked) totalServicios += parseFloat(el.value);
        });
        return totalServicios;
    }

    // Verificar la fecha en tiempo real enviando fecha Y locación
    async function verificarFecha() {
        const fechaInput = document.getElementById('fecha_evento').value;
        const status = document.getElementById('statusFecha');
        const resFechaText = document.getElementById('resFechaText');
        const btnReserva = document.querySelector('.btn-confirm');
        const locacion = document.getElementById('resLocacion').innerText.trim();

        if (resFechaText) resFechaText.innerText = fechaInput || '-';
        if (!fechaInput) return;

        status.style.background = "#f1f5f9";
        status.style.color = "#475569";
        status.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Verificando disponibilidad...`;

        try {
            const response = await fetch(`api/verificar_fecha.php?fecha=${encodeURIComponent(fechaInput)}&locacion=${encodeURIComponent(locacion)}`);
            const data = await response.json();

            if (data.disponible) {
                status.style.background = "#dcfce7";
                status.style.color = "#15803d";
                status.innerHTML = `<i class="fas fa-check-circle"></i> Fecha Disponible`;
                if (btnReserva) btnReserva.disabled = false;
            } else {
                status.style.background = "#fee2e2";
                status.style.color = "#b91c1c";
                status.innerHTML = `<i class="fas fa-times-circle"></i> Fecha NO disponible para esta locación`;
                if (btnReserva) btnReserva.disabled = true;
            }
        } catch (error) {
            console.error("Error al consultar fecha:", error);
            status.style.background = "#dcfce7";
            status.style.color = "#15803d";
            status.innerHTML = `<i class="fas fa-check-circle"></i> Fecha Disponible`;
        }
    }

    // Función Única y Corregida de Reserva
    async function confirmarReserva() {
        const nombre   = document.getElementById('nombre_cliente').value.trim();
        const email    = document.getElementById('email_cliente').value.trim();
        const celular  = document.getElementById('celular_cliente').value.trim();
        const fecha    = document.getElementById('fecha_evento').value;
        const locacion = document.getElementById('resLocacion').innerText.trim();
        
        const cotizacionIdTexto = document.getElementById('resId').innerText.replace('#', '').trim();
        const cotizacion_id     = cotizacionIdTexto && cotizacionIdTexto !== '-' ? parseInt(cotizacionIdTexto) : null;

        if (!nombre || !email || !fecha || !locacion) {
            alert('Por favor, completa los campos obligatorios: Nombre, Correo y Fecha del evento.');
            return;
        }

        const payload = {
            nombre: nombre,
            email: email,
            celular: celular,
            fecha: fecha,
            locacion: locacion,
            cotizacion_id: cotizacion_id
        };

        const btnReserva = document.querySelector('.btn-confirm');

        try {
            if (btnReserva) btnReserva.disabled = true;

            const response = await fetch('api/guardar_reserva.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (data.status === 'success') {
                alert('¡Reserva registrada! ' + data.message);
                verificarFecha();
            } else if (data.status === 'warning') {
                alert('Atención: ' + data.message);
            } else {
                alert('Error: ' + data.message);
                if (btnReserva) btnReserva.disabled = false;
            }

        } catch (error) {
            console.error('Error en la solicitud:', error);
            alert('Ocurrió un error al procesar la reserva.');
            if (btnReserva) btnReserva.disabled = false;
        }
    }

    function obtenerPlatosSeleccionados() {
        const entradaSel = document.querySelector('input[name="platillo_entrada"]:checked');
        const fuerteSel = document.querySelector('input[name="platillo_fuerte"]:checked');
        const postreSel = document.querySelector('input[name="platillo_postre"]:checked');

        let lista = [];
        if (entradaSel) lista.push(entradaSel.value);
        if (fuerteSel) lista.push(fuerteSel.value);
        if (postreSel) lista.push(postreSel.value);
        return lista;
    }

    function calcularCotizacion() {
        const costoServicios = obtenerCostoServiciosExtra();
        document.getElementById('resServicios').innerText = '$' + costoServicios.toFixed(2);

        const platos = obtenerPlatosSeleccionados();
        document.getElementById('resPlatosSel').innerText = platos.length > 0 ? platos.join(', ') : '-';

        const invitados = parseInt(document.getElementById('invitados').value) || 0;
        const subtotalComida = invitados * 25; 
        const costoBarra = document.getElementById('barra_libre').checked ? (invitados * 10) : 0;
        const total = locacionPrecio + costoServicios + subtotalComida + costoBarra;

        document.getElementById('resInvitados').innerText = invitados + ' personas';
        document.getElementById('resComida').innerText = '$' + subtotalComida.toFixed(2);
        document.getElementById('resBarra').innerText = '$' + costoBarra.toFixed(2);
        document.getElementById('resTotal').innerText = '$' + total.toFixed(2);
    }



    const timelineSugeridoMC = [
        { hora: "19:00", actividad: "Recepción de Invitados" },
        { hora: "20:00", actividad: "Brindis Principal" },
        { hora: "20:30", actividad: "Cena / Banquete" }
    ];

    function cargarTimelineSugerido() {
        const container = document.getElementById('timelineContainer');
        container.innerHTML = '';
        timelineSugeridoMC.forEach(item => {
            container.appendChild(crearFilaTimelineHTML(item.hora, item.actividad));
        });
    }

    function agregarFilaTimeline() {
        document.getElementById('timelineContainer').appendChild(crearFilaTimelineHTML());
    }

    function crearFilaTimelineHTML(hora = '', actividad = '') {
        const div = document.createElement('div');
        div.className = 'timeline-item-row';
        div.innerHTML = `
            <input type="time" value="${hora}">
            <input type="text" value="${actividad}" placeholder="Descripción...">
            <button type="button" onclick="this.parentElement.remove()" style="color:red; background:none; border:none; cursor:pointer; font-weight:bold;">✕</button>
        `;
        return div;
    }

    document.addEventListener('DOMContentLoaded', () => {
        agregarElemento('pista');
        agregarElemento('mesa');
        
        // Formateo seguro de fecha local (Evita desfase de zonas horarias)
        const hoy = new Date();
        hoy.setDate(hoy.getDate() + 7);
        const yyyy = hoy.getFullYear();
        const mm = String(hoy.getMonth() + 1).padStart(2, '0');
        const dd = String(hoy.getDate()).padStart(2, '0');
        
        document.getElementById('fecha_evento').value = `${yyyy}-${mm}-${dd}`;

        verificarFecha();
        calcularCotizacion();
        actualizarMaridaje();
    });


async function enviarMensajeChat() {
    const input = document.getElementById('chatInput');
    const chatBox = document.getElementById('chat-box');
    const message = input.value.trim();

    if (!message) return;

    // 1. Mostrar el mensaje del usuario en la pantalla
    chatBox.innerHTML += `<div class="chat-bubble user">${message}</div>`;
    input.value = '';
    chatBox.scrollTop = chatBox.scrollHeight;

    // 2. Mostrar indicador temporal de "Escribiendo..."
    const loadingId = 'typing-' + Date.now();
    chatBox.innerHTML += `<div class="chat-bubble bot" id="${loadingId}"><i>Pensando...</i></div>`;
    chatBox.scrollTop = chatBox.scrollHeight;

    // 3. Consultar a la API a través de chat_backend.php
    try {
        const response = await fetch('chat_backend.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: message })
        });
        
        const data = await response.json();
        
        // 4. Reemplazar "Pensando..." con la respuesta real de Gemini
        const loadingElem = document.getElementById(loadingId);
        if (loadingElem) {
            loadingElem.innerText = data.reply;
        }
    } catch (error) {
        const loadingElem = document.getElementById(loadingId);
        if (loadingElem) {
            loadingElem.innerText = 'Ocurrió un error al conectar con el asistente.';
        }
    }
    
    chatBox.scrollTop = chatBox.scrollHeight;
}

</script>
</body>
</html>