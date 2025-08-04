@extends('admin.layouts.app')

@section('admin.content')
    <?php
    // Шлях до CSS-файлу з іконками
    $cssFile = '../public/plugins/fontawesome-free/css/all.css';
    
    // Зчитуємо файл
    $css = file_get_contents($cssFile);
    
    // Регулярний вираз для витягування класів
    preg_match_all('/\.fa-([a-z0-9\-]+):before\s*\{/', $css, $matches);
    
    // Унікальні іконки
    $icons = array_unique($matches[1]);
    sort($icons);
    
    ?>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .icon-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .icon-box i {
            font-size: 24px;
            width: 30px;
        }
    </style>

@section('admin.content.header')
    Font Awesome Icons ({{ count($icons) }} total)
@endsection
{{-- @section('', "Font Awesome Icons (<?= count($icons) ?> total)") --}}



<div class="icon-grid">
    <?php foreach ($icons as $icon): ?>
    <div class="icon-box">
        <i class="fas fa-<?= htmlspecialchars($icon) ?>"></i>
        <i class="far fa-<?= htmlspecialchars($icon) ?>"></i>
        <i class="fab fa-<?= htmlspecialchars($icon) ?>"></i>
        <span><?= htmlspecialchars($icon) ?></span>
    </div>
    <?php endforeach; ?>
</div>
@endsection