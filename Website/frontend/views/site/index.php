<?php
// Website/frontend/views/site/index.php
?>
<style>
    .hero-roles {
        position: relative;
        background-image: url('<?= Yii::getAlias('@web') ?>/images/logo.png');
        background-size: cover;
        background-position: center;
        padding: 60px 0;
        color: #fff;
    }

    .hero-roles::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 0;
    }

    .roles-container {
        position: relative;
        z-index: 1;
    }

    .role-card {
        background: rgba(255,255,255,0.95);
        color: #222;
        border: none;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .role-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0,0,0,0.2);
    }

    .role-title {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .lead-white {
        color: rgba(255,255,255,0.95);
    }

    .creator {
        margin-top: 40px;
        padding: 24px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
    }

    .creator img {
        width: 96px;
        height: 96px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    @media (max-width: 767px) {
        .hero-roles { padding: 40px 0; }
        .creator { text-align: center; }
        .creator .creator-info { margin-top: 12px; }
    }
</style>




<div class="container py-4">
    <h1 class="text-center mb-3">Bem-vindo à Plataforma de Saúde</h1>
    <p class="text-center lead text-muted">Aceda facilmente às áreas consoante o seu perfil.</p>

    <section class="hero-roles mt-4 rounded">
        <div class="container roles-container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 col-sm-8">
                    <div class="role-card">
                        <h3 class="role-title">Paciente</h3>
                        <p>Aceda à área de eventos, consulte informações e participe em atividades de saúde.</p>
                        <a href="/paciente" class="btn btn-outline-primary btn-sm">Aceder</a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-8">
                    <div class="role-card">
                        <h3 class="role-title">Colaborador</h3>
                        <p>Gestão de eventos, moderação de participantes e ferramentas administrativas.</p>
                        <a href="/colaborador" class="btn btn-outline-primary btn-sm">Aceder</a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-8">
                    <div class="role-card">
                        <h3 class="role-title">Serviços</h3>
                        <p>Informações gerais sobre serviços, contacto e horários.</p>
                        <a href="/servicos" class="btn btn-outline-primary btn-sm">Aceder</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="creator d-flex align-items-center gap-3">
            <div class="creator-photo">
                <img src="https://avatars.githubusercontent.com/u/000?v=4" alt="Foto do criador">
            </div>
            <div class="creator-info">
                <h4 class="mb-1">Afonso Guedes</h4>
                <p class="mb-1 text-muted">Desenvolvedor Full‑stack — Design e implementação da plataforma</p>
                <p class="mb-0"><small class="text-muted">Email: <a href="mailto:2241604@ipleiria.pt">2241604@ipleiria.pt</a> · GitHub: <a href="https://github.com/Souber8" target="_blank" rel="noopener noreferrer">@Souber8</a></small></p>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="creator d-flex align-items-center gap-3">
            <div class="creator-photo">
                <img src="https://avatars.githubusercontent.com/u/000?v=4" alt="Foto do criador">
            </div>
            <div class="creator-info">
                <h4 class="mb-1">Pedro Coelho</h4>
                <p class="mb-1 text-muted">Desenvolvedor Full‑stack — Design e implementação da plataforma</p>
                <p class="mb-0"><small class="text-muted">Email: <a href="mailto:2241614@ipleiria.pt">2241614@ipleiria.pt</a> · GitHub: <a href="https://github.com/Souber8" target="_blank" rel="noopener noreferrer">@Souber8</a></small></p>
            </div>
        </div>
    </div>
</div>
