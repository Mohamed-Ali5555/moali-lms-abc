@extends('theme::layouts.master')
@push('title', get_phrase('My Bootcamps'))

<style>
    :root {



        /* نظام الألوان الأساسي */
        --primary-color: rgb(var(--c-accent-rgb));
        --primary-light: rgb(var(--c-secondary-rgb));
        --secondary-color: rgb(var(--c-primary-rgb));
        --accent-color: rgb(var(--c-accent-hover-rgb));
        --light-color: #f8fafc;
        --dark-color: rgb(var(--c-primary-rgb));
        --text-color: rgb(var(--c-text-rgb));

        /* ألوان الحالة */
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;

        /* التصميمات */
        --border-radius: 16px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --box-shadow-dark: 0 10px 30px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);


    }





    /* ======= Main Header ======= */
    .bootcamp-details-main-header {
        background: var(--main-gradient);
        padding: 100px 0 60px;
        position: relative;
        overflow: hidden;
        margin-top: 70px;
    }

    .header-decoration {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    /* ======= Bootcamp Hero ======= */
    .bootcamp-hero {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
        color: white;
        align-items: start;
    }

    @media (max-width: 992px) {
        .bootcamp-hero {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }

    .bootcamp-thumbnail-large {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        transition: var(--transition);
    }

    .bootcamp-thumbnail-large:hover {
        transform: translateY(-5px);
    }

    .bootcamp-thumbnail-large img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .bootcamp-thumbnail-large:hover img {
        transform: scale(1.05);
    }

    .bootcamp-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, rgb(var(--c-accent-rgb)), rgb(var(--c-secondary-rgb)));
        color: white;
        padding: 8px 18px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(var(--c-accent-rgb), 0.3);
    }

    .bootcamp-info {
        padding: 10px 0;
    }

    .bootcamp-title-main {
        font-size: 2.4rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.3;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        background: linear-gradient(to right, #ffffff, #e0f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bootcamp-meta {
        display: flex;
        gap: 30px;
        margin: 25px 0;
        flex-wrap: wrap;
    }

    .bootcamp-details-meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.05rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 10px 18px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
    }

    .bootcamp-details-meta-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .meta-icon {
        font-size: 1.3rem;
        opacity: 0.9;
    }

    .bootcamp-details-bootcamp-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .bootcamp-details-action-btn {
        padding: 14px 28px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
    }

    .bootcamp-details-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .bootcamp-details-action-btn:hover::before {
        left: 100%;
    }

    .bootcamp-details-action-btn.invoice {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .bootcamp-details-action-btn.invoice:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.15);
    }

    .bootcamp-details-action-btn.secondary {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .bootcamp-details-action-btn.secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.1);
    }

    /* ======= Main Content ======= */
    .bootcamp-details-main-container {
        max-width: 1200px;
        margin: -30px auto 60px;
        padding: 0 20px;
        position: relative;
    }

    /* ======= Dashboard Stats ======= */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: rgb(var(--c-card-bg-rgb));
        border-radius: var(--border-radius);
        padding: 30px;
        text-align: center;
        box-shadow: var(--box-shadow);
        border: 1px solid rgb(var(--c-border-rgb));
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--box-shadow-dark);
    }

    .stat-icon {
        font-size: 2.8rem;
        margin-bottom: 20px;
        display: block;
        background: var(--main-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        display: block;
        margin-bottom: 8px;
        background: var(--main-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 1rem;
        color: rgb(var(--c-gray-rgb));
        font-weight: 500;
    }

    /* ======= Modules Section ======= */
    .modules-section {
        background: rgb(var(--c-card-bg-rgb));
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin-bottom: 50px;
        border: 1px solid rgb(var(--c-border-rgb));
    }

    .section-header {
        padding: 30px;
        background: linear-gradient(135deg, rgba(var(--c-bg-rgb), 0.5), rgba(var(--c-bg-rgb), 0.8));
        border-bottom: 2px solid rgb(var(--c-border-rgb));
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.6rem;
        font-weight: 700;
        color: rgb(var(--c-text-rgb));
    }

    .section-title i {
        color: rgb(var(--c-accent-rgb));
        font-size: 2rem;
    }

    .modules-container {
        padding: 30px;
    }

    /* ======= Module Card ======= */
    .module-card {
        background: rgb(var(--c-card-bg-rgb));
        border-radius: var(--border-radius);
        border: 1px solid rgb(var(--c-border-rgb));
        margin-bottom: 25px;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--box-shadow);
        position: relative;
    }

    .module-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: var(--main-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .module-card:hover {
        border-color: rgb(var(--c-accent-rgb));
        box-shadow: var(--box-shadow-dark);
        transform: translateY(-3px);
    }

    .module-card:hover::before {
        opacity: 1;
    }

    .module-header {
        padding: 25px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgb(var(--c-bg-rgb));
        transition: var(--transition);
        position: relative;
    }

    .module-card:hover .module-header {
        background: rgba(var(--c-accent-rgb), 0.05);
    }

    .module-title-section {
        flex: 1;
        min-width: 0;
        padding-right: 20px;
    }

    .module-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: rgb(var(--c-text-rgb));
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .module-card:hover .module-title {
        color: rgb(var(--c-accent-rgb));
    }

    .module-meta {
        display: flex;
        gap: 25px;
        flex-wrap: wrap;
    }

    .module-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgb(var(--c-gray-rgb));
        font-size: 0.95rem;
        font-weight: 500;
    }

    .module-status {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .module-badge {
        padding: 8px 18px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .module-badge.available {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
    }

    .module-badge.locked {
        background: linear-gradient(135deg, rgb(var(--c-gray-rgb)), rgb(var(--c-gray-rgb), 0.8));
        color: white;
    }

    .module-toggle {
        background: rgba(var(--c-accent-rgb), 0.1);
        border: none;
        font-size: 1.5rem;
        color: rgb(var(--c-accent-rgb));
        cursor: pointer;
        padding: 8px;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .module-toggle:hover {
        background: rgba(var(--c-accent-rgb), 0.2);
        transform: rotate(90deg);
    }

    .module-toggle.rotated {
        transform: rotate(180deg);
    }

    .module-content {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s ease;
    }

    .module-content.expanded {
        padding: 30px;
        max-height: 2000px;
    }

    /* ======= Live Classes ======= */
    .live-classes-section {
        margin-bottom: 35px;
    }

    .section-subtitle {
        font-size: 1.2rem;
        font-weight: 700;
        color: rgb(var(--c-text-rgb));
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgb(var(--c-border-rgb));
        position: relative;
    }

    .section-subtitle::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 80px;
        height: 2px;
        background: var(--main-gradient);
    }

    .live-classes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .class-card {
        background: rgb(var(--c-card-bg-rgb));
        border-radius: var(--border-radius);
        padding: 25px;
        border: 1px solid rgb(var(--c-border-rgb));
        transition: var(--transition);
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
    }

    .class-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--main-gradient);
    }

    .class-card:hover {
        border-color: rgb(var(--c-accent-rgb));
        transform: translateY(-5px);
        box-shadow: var(--box-shadow-dark);
    }

    .class-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .class-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: rgb(var(--c-text-rgb));
        margin-bottom: 15px;
        line-height: 1.4;
        flex: 1;
        padding-right: 15px;
    }

    .class-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .badge-live {
        background: linear-gradient(135deg, var(--danger-color), #f87171);
        color: white;
    }

    .badge-upcoming {
        background: linear-gradient(135deg, var(--warning-color), #fbbf24);
        color: white;
    }

    .badge-completed {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
    }

    .class-time {
        color: rgb(var(--c-gray-rgb));
        font-size: 0.95rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgb(var(--c-bg-rgb));
        padding: 12px 15px;
        border-radius: 10px;
        border-left: 3px solid rgb(var(--c-accent-rgb));
    }

    .class-actions {
        display: flex;
        gap: 12px;
    }

    .class-btn {
        flex: 1;
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        text-decoration: none;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
    }

    .class-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .class-btn:hover::before {
        left: 100%;
    }

    .class-btn.join {
        background: var(--main-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(var(--c-accent-rgb), 0.2);
    }

    .class-btn.join:hover {
        background: linear-gradient(135deg, rgb(var(--c-accent-hover-rgb)), rgb(var(--c-accent-rgb)));
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(var(--c-accent-rgb), 0.3);
    }

    .class-btn.join.disabled {
        background: linear-gradient(135deg, rgb(var(--c-gray-rgb)), rgba(var(--c-gray-rgb), 0.8));
        cursor: not-allowed;
        opacity: 0.7;
    }

    .class-btn.join.disabled:hover {
        transform: none;
        box-shadow: none;
    }

    /* ======= Resources Section ======= */
    .resources-section {
        margin-top: 35px;
    }

    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .resource-card {
        background: rgb(var(--c-card-bg-rgb));
        border-radius: var(--border-radius);
        padding: 25px;
        border: 1px solid rgb(var(--c-border-rgb));
        transition: var(--transition);
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
    }

    .resource-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--success-color), #34d399);
    }

    .resource-card:hover {
        border-color: rgb(var(--c-accent-rgb));
        transform: translateY(-5px);
        box-shadow: var(--box-shadow-dark);
    }

    .resource-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .resource-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: rgb(var(--c-text-rgb));
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        padding-right: 15px;
    }

    .resource-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .badge-resource {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
    }

    .badge-record {
        background: var(--main-gradient);
        color: white;
    }

    .resource-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgb(var(--c-border-rgb));
    }

    .resource-date {
        color: rgb(var(--c-gray-rgb));
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .resource-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .resource-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .resource-btn:hover::before {
        left: 100%;
    }

    .resource-btn.download {
        background: rgba(var(--c-accent-rgb), 0.1);
        color: rgb(var(--c-accent-rgb));
        border: 2px solid rgb(var(--c-accent-rgb));
    }

    .resource-btn.download:hover {
        background: var(--main-gradient);
        color: white;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(var(--c-accent-rgb), 0.2);
    }

    .resource-btn.play {
        background: var(--main-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(var(--c-accent-rgb), 0.2);
    }

    .resource-btn.play:hover {
        background: linear-gradient(135deg, rgb(var(--c-accent-hover-rgb)), rgb(var(--c-accent-rgb)));
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(var(--c-accent-rgb), 0.3);
    }

    /* ======= Empty States ======= */
    .empty-state {
        text-align: center;
        padding: 50px 30px;
        color: rgb(var(--c-gray-rgb));
        background: rgb(var(--c-bg-rgb));
        border-radius: var(--border-radius);
        border: 2px dashed rgb(var(--c-border-rgb));
    }

    .empty-icon {
        font-size: 3.5rem;
        margin-bottom: 20px;
        opacity: 0.6;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .empty-message {
        font-size: 1.2rem;
        margin-bottom: 25px;
        color: rgb(var(--c-text-rgb));
    }

    /* ======= Responsive Design ======= */
    @media (max-width: 1200px) {
        .header-content,
        .bootcamp-details-main-container {
            max-width: 100%;
        }
    }

    @media (max-width: 992px) {
        .bootcamp-hero {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .bootcamp-thumbnail-large {
            max-width: 400px;
            margin: 0 auto;
        }

        .bootcamp-meta {
            justify-content: center;
        }

        .bootcamp-details-bootcamp-actions {
            justify-content: center;
        }

        .live-classes-grid,
        .resources-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .bootcamp-details-main-header {
            padding: 80px 0 40px;
            margin-top: 60px;
        }

        .bootcamp-title-main {
            font-size: 1.8rem;
        }

        .bootcamp-meta {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .bootcamp-details-meta-item {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }

        .bootcamp-details-section-header {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
            gap: 15px;
        }

        .bootcamp-details-module-header {
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        .bootcamp-details-module-status {
            justify-content: space-between;
        }

        .live-classes-grid,
        .resources-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .bootcamp-title-main {
            font-size: 1.6rem;
        }

        .bootcamp-details-bootcamp-actions {
            flex-direction: column;
        }

        .bootcamp-details-action-btn {
            width: 100%;
            justify-content: center;
        }

        .class-actions {
            flex-direction: column;
        }

        .resource-info {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .resource-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* ======= Animation ======= */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .module-card,
    .class-card,
    .resource-card {
        animation: fadeInUp 0.6s ease forwards;
        animation-delay: calc(var(--order) * 0.1s);
        opacity: 0;
    }

    /* ======= Smooth Scroll ======= */
    html {
        scroll-behavior: smooth;
    }

    /* ======= Loading Animation ======= */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    .loading-shimmer {
        background: linear-gradient(90deg,
            rgba(var(--c-border-rgb), 0.1) 25%,
            rgba(var(--c-border-rgb), 0.2) 50%,
            rgba(var(--c-border-rgb), 0.1) 75%);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite linear;
    }
</style>

@php
    $modules = App\Models\BootcampModule::where('bootcamp_id', $bootcamp->id)->get();
@endphp

@section('content')
    <section class="my-course-content mt-50" style="direction: rtl; margin-top: 80px;">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9">
                    <!-- Main Header -->
                    <header class="bootcamp-details-main-header">
                        <div class="header-decoration"></div>
                        <div class="header-content">
                            <div class="bootcamp-hero">
                                <div class="bootcamp-thumbnail-large">
                                    <span class="bootcamp-badge">معسكرك</span>
                                    <img src="{{ get_image($bootcamp->thumbnail) }}" alt="{{ $bootcamp->title }}">
                                </div>

                                <div class="bootcamp-info">
                                    <h1 class="bootcamp-title-main">{{ $bootcamp->title }}</h1>

                                    <div class="bootcamp-meta">
                                        <div class="bootcamp-details-meta-item">
                                            <span class="meta-icon">📅</span>
                                            <span>{{ date('d M, Y', $bootcamp->publish_date) }}</span>
                                        </div>
                                        <div class="bootcamp-details-meta-item">
                                            <span class="meta-icon">🎓</span>
                                            <span>{{ count_bootcamp_classes($bootcamp->id) }} جلسات</span>
                                        </div>
                                        <div class="bootcamp-details-meta-item">
                                            <span class="meta-icon">📚</span>
                                            <span>{{ $modules->count() }} وحدات تعليمية</span>
                                        </div>
                                    </div>

                                    <div class="bootcamp-details-bootcamp-actions">
                                        <a href="{{ route('theme.my.bootcamp.invoice', ['id' => $bootcamp->id]) }}"
                                           class="bootcamp-details-action-btn invoice">
                                            <span>📋</span> عرض الفاتورة
                                        </a>
                                        <a href="{{ route('theme.my.bootcamps') }}" class="bootcamp-details-action-btn secondary">
                                            <span>⬅️</span> العودة للمعسكرات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Main Container -->
                    <main class="bootcamp-details-main-container">
                        <!-- Modules Section -->
                        <div class="modules-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <span>📋</span>
                                    <span>الوحدات التعليمية</span>
                                </div>
                                <div class="modules-count">
                                    {{ $modules->count() }} وحدة متاحة
                                </div>
                            </div>

                            @if($modules->count() > 0)
                                <div class="modules-container">
                                    @foreach($modules as $module)
                                        @php
                                            $is_available = 1;
                                            if($module->restriction == 1) {
                                                $is_available = time() >= $module->publish_date ? 1 : 0;
                                            } elseif($module->restriction == 2) {
                                                $is_available = (time() >= $module->publish_date && time() <= $module->expiry_date) ? 1 : 0;
                                            }
                                        @endphp

                                        <div class="module-card" style="--order: {{ $loop->index }}">
                                            <div class="module-header" onclick="toggleModule({{ $module->id }})">
                                                <div class="module-title-section">
                                                    <h3 class="module-title">{{ $module->title }}</h3>
                                                    <div class="module-meta">
                                                        <div class="bootcamp-details-module-meta-item">
                                                            <span>📅</span>
                                                            <span>
                                                                @if($module->restriction == 1)
                                                                    {{ get_phrase('Available from : ') }}
                                                                    {{ date('d-M-Y', $module->publish_date) }}
                                                                @elseif($module->restriction == 2)
                                                                    {{ get_phrase('Available within : ') }}
                                                                    {{ date('d-M-Y', $module->publish_date) }} -
                                                                    {{ date('d-M-Y', $module->expiry_date) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="bootcamp-details-module-meta-item">
                                                            <span>🎓</span>
                                                            <span>{{ count_bootcamp_classes($module->id, 'module') }} جلسات</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="module-status">
                                                    @if($is_available)
                                                        <span class="module-badge available">متاح</span>
                                                    @else
                                                        <span class="module-badge locked">مغلق</span>
                                                    @endif
                                                    <button class="module-toggle" id="toggle-{{ $module->id }}"
                                                            onclick="event.stopPropagation(); toggleModule({{ $module->id }})">
                                                        ▼
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="module-content" id="content-{{ $module->id }}">
                                                @php
                                                    $live_classes = App\Models\BootcampLiveClass::where('module_id', $module->id)->get();
                                                    $resources = App\Models\BootcampResource::where('module_id', $module->id)->get();
                                                @endphp

                                                @if($is_available)
                                                    @if($live_classes->count() > 0)
                                                        <div class="live-classes-section">
                                                            <h4 class="section-subtitle">الجلسات المباشرة</h4>
                                                            <div class="live-classes-grid">
                                                                @foreach($live_classes as $class)
                                                                    <div class="class-card" style="--order: {{ $loop->index }}">
                                                                        <div class="class-header">
                                                                            <h4 class="class-title">{{ $class->title }}</h4>
                                                                            <span class="class-badge
                                                                                @if($class->status == 'live') badge-live
                                                                                @elseif($class->status == 'completed') badge-completed
                                                                                @else badge-upcoming
                                                                                @endif">
                                                                                @if($class->status == 'live') مباشر
                                                                                @elseif($class->status == 'completed') مكتمل
                                                                                @else قادم
                                                                                @endif
                                                                            </span>
                                                                        </div>

                                                                        <div class="class-time">
                                                                            <span>⏰</span>
                                                                            <span>
                                                                                {{ date('d M, Y', $class->schedule_date) }} -
                                                                                {{ date('h:i A', $class->schedule_date) }}
                                                                            </span>
                                                                        </div>

                                                                        <div class="class-actions">
                                                                            <a href="{{ class_started($class->id)
                                                                                ? route('theme.bootcamp.live.class.join', slugify($class->title))
                                                                                : 'javascript:void(0);' }}"
                                                                               class="class-btn join {{ class_started($class->id) ? '' : 'disabled' }}">
                                                                                <span>🚀</span>
                                                                                {{ $class->status == 'live' ? get_phrase('Join Now') : ucfirst($class->status) }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($resources->count() > 0)
                                                        <div class="resources-section">
                                                            <h4 class="section-subtitle">الموارد التعليمية</h4>
                                                            <div class="resources-grid">
                                                                @foreach($resources as $resource)
                                                                    <div class="resource-card" style="--order: {{ $loop->index }}">
                                                                        <div class="resource-header">
                                                                            <h5 class="resource-title">{{ $resource->title }}</h5>
                                                                            <span class="resource-badge
                                                                                @if($resource->upload_type == 'resource') badge-resource
                                                                                @else badge-record
                                                                                @endif">
                                                                                @if($resource->upload_type == 'resource') ملف
                                                                                @else تسجيل
                                                                                @endif
                                                                            </span>
                                                                        </div>

                                                                        <div class="resource-info">
                                                                            <div class="resource-date">
                                                                                <span>📅</span>
                                                                                <span>{{ date('d M, Y', $resource->create_at) }}</span>
                                                                            </div>
                                                                            @if($resource->upload_type == 'resource')
                                                                                <a href="{{ route('theme.bootcamp.resource.download', $resource->id) }}"
                                                                                   class="resource-btn download">
                                                                                    <span>📥</span> تحميل
                                                                                </a>
                                                                            @else
                                                                                <a href="{{ route('theme.bootcamp.resource.play', $resource->title) }}"
                                                                                   class="resource-btn play">
                                                                                    <span>▶️</span> تشغيل
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($live_classes->count() < 1 && $resources->count() < 1)
                                                        <div class="empty-state">
                                                            <div class="empty-icon">📭</div>
                                                            <p class="empty-message">لا توجد محتويات متاحة في هذه الوحدة</p>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="empty-state">
                                                        <div class="empty-icon">🔒</div>
                                                        <p class="empty-message">هذه الوحدة غير متاحة حالياً</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">📚</div>
                                    <p class="empty-message">لا توجد وحدات تعليمية متاحة لهذا المعسكر</p>
                                </div>
                            @endif
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects
        const cards = document.querySelectorAll('.module-card, .class-card, .resource-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Animate cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        cards.forEach(card => {
            observer.observe(card);
        });
    });

    function toggleModule(moduleId) {
        const content = document.getElementById(`content-${moduleId}`);
        const toggle = document.getElementById(`toggle-${moduleId}`);

        if (content.classList.contains('expanded')) {
            content.classList.remove('expanded');
            toggle.classList.remove('rotated');
        } else {
            // Close all other modules
            document.querySelectorAll('.module-content.expanded').forEach(expanded => {
                expanded.classList.remove('expanded');
            });
            document.querySelectorAll('.module-toggle.rotated').forEach(rotated => {
                rotated.classList.remove('rotated');
            });

            content.classList.add('expanded');
            toggle.classList.add('rotated');

            // Smooth scroll to module
            content.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }
    }
</script>
