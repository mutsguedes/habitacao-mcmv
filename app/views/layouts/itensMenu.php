<?php

namespace app\views\layouts;

$itens = [
    ['label' => "<span class='fas fa-home fa-sm'></span>
                <span>&nbsp;Inìcio</span>", 'url' => ['/site/index'],],
    ['label' => "<span class='fas fa-at fa-sm'></span>
                <span>&nbsp;Contato</span>", 'url' => ['/site/contact']],
    ['label' => "<span class='fas fa-comment-dots fa-sm'></span>
                <span>&nbsp;Sobre</span>", 'url' => ['/site/about']],
];
$itensLogadoMCMV = [
    ['label' => "<span class='fas fa-home fa-sm'></span>
                <span>&nbsp;Inìcio</span>", 'url' => ['/site/index'],],
    [
        'label' => "<span class='fas fa-user-tie'></span>
                <span>&nbsp;Responsável</span>",
        'items' => [
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar</span>", 'url' => ['/res/responsaveis/index']],
            ['label' => "<span class='fas fa-user-plus'></span>
                        <span>&nbsp;Criar</span>", 'url' => ['/res/responsaveis/pesquisa']],
        ],
    ],
    /*[
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],*/

    /* ['label' => "<span class='fas fa-book-open'></span>
                <span>&nbsp;Relatórios</span>", 'url' => ['/imprel/relatorios/rel-view']], */
    [
        'label' => "<span class='fas fa-chart-line'></span>
                    <span>&nbsp;Indicadores</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-wheelchair'></span>
                        <span>&nbsp;Deficiência</span>",
                'url' => ['/ind/indicadores/deficiencia'],
            ],
            [
                'label' => "<span class='fas fa-graduation-cap'></span>
                        <span>&nbsp;Escolaridade</span>",
                'url' => ['/ind/indicadores/escolaridade'],
            ],
            [
                'label' => "<span class='fas fa-transgender'></span>
                            <span>&nbsp;Genero</span>",
                'url' => ['/ind/indicadores/genero'],
            ],
            [
                'label' => "<span class='fas fa-map-marked-alt'></span>
                        <span>&nbsp;Naturalidade</span>",
                'url' => ['/ind/indicadores/naturalidade'],
            ],
            '<div class="dropdown-divider"></div>',
            [
                'label' => "<span class='fas fa-plus'></span>
                        <span>&nbsp;Pessoa</span>",
                'items' => [
                    [
                        'label' => "<span class='fas fa-transgender'></span>
                                <span>&nbsp;Total Pessoa</span>",
                        'url' => ['/ind/indicadores/total-pessoa'],
                    ],
                    [
                        'label' => "<span class='fas fa-venus'></span>
                                <span>&nbsp;Total Mulheres</span>",
                        'url' => ['/ind/indicadores/total-mulher'],
                    ],
                    [
                        'label' => "<span class='fas fa-mars'></span>
                                <span>&nbsp;Total Homens</span>",
                        'url' => ['/ind/indicadores/total-homem'],
                    ],
                    [
                        'label' => "<span class='fas fa-mars-stroke'></span>
                                <span>&nbsp;Total Responsáveis</span>",
                        'url' => ['/ind/indicadores/total-responsavel'],
                    ],
                ],
            ],
        ],
    ],
    ['label' => "<span class='fas fa-project-diagram'></span>
                <span>&nbsp;Sistema</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSystem']],
    ['label' => "<span class='fas fa-user-circle fa-sm'></span>
                <span>&nbsp;Colaborador</span>", 'url' => ['/user/user/collaborator']],
    ['label' => "<span class='fas fa-at fa-sm'></span>
                <span>&nbsp;Contato</span>", 'url' => ['/site/contact']],
    ['label' => "<span class='fas fa-comment-dots fa-sm'></span>
                <span>&nbsp;Sobre</span>", 'url' => ['/site/about']],
];

$itensAdminMCMV = [
    ['label' => "<span class='fas fa-book-open'></span>
                <span>&nbsp;Relatórios</span>", 'url' => ['/imprel/relatorios/rel-view']],
    ['label' => "<span class='fas fa-user-plus fa-sm'></span>
                <span>&nbsp;Inscrição</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSignUp1']],
    [
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],
    [
        'label' => "<span class='fas fa-sitemap'></span>
                <span>&nbsp;Administração</span>",
        'url' => ['/admin'],
    ],
];

$itensAdminPAC = [
    ['label' => "<span class='fas fa-user-plus fa-sm'></span>
                <span>&nbsp;Inscrição</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSignUp1']],
    [
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],
    [
        'label' => "<span class='fas fa-sitemap'></span>
                <span>&nbsp;Administração</span>",
        'url' => ['/admin']
    ]
];

$itensAdminPHPMI = [
    ['label' => "<span class='fas fa-user-plus fa-sm'></span>
                <span>&nbsp;Inscrição</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSignUp1']],
    [
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],
    [
        'label' => "<span class='fas fa-sitemap'></span>
                <span>&nbsp;Administração</span>",
        'url' => ['/admin']
    ]
];

$itensLogadoPAC = [
    ['label' => "<span class='fas fa-home fa-sm'></span>
                <span>&nbsp;Inìcio</span>", 'url' => ['/site/index'],],
    [
        'label' => "<span class='fas fa-user-tie'></span>
                    <span>&nbsp;Responsável</span>",
        'items' => [
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar</span>", 'url' => ['/res/responsaveis/index']],
            ['label' => "<span class='fas fa-user-plus'></span>
                        <span>&nbsp;Criar</span>", 'url' => ['/res/responsaveis/pesquisa']],
        ],
    ],
    /*[
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],*/
    ['label' => "<span class='fas fa-search-location'></span>
                <span>&nbsp;Cras</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkCras']],
    ['label' => "<span class='fas fa-project-diagram'></span>
                <span>&nbsp;Sistema</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSystem']],
    ['label' => "<span class='fas fa-user-circle fa-sm'></span>
                <span>&nbsp;Colaborador</span>", 'url' => ['/user/user/collaborator']],
    ['label' => "<span class='fas fa-at fa-sm'></span>
                <span>&nbsp;Contato</span>", 'url' => ['/site/contact']],
    ['label' => "<span class='fas fa-comment-dots fa-sm'></span>
                <span>&nbsp;Sobre</span>", 'url' => ['/site/about']],
];

$itensLogadoPHPMI = [
    ['label' => "<span class='fas fa-home fa-sm'></span>
                <span>&nbsp;Inìcio</span>", 'url' => ['/site/index'],],
    [
        'label' => "<span class='fas fa-user-tie'></span>
                    <span>&nbsp;Responsável</span>",
        'items' => [
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar</span>", 'url' => ['/res/responsaveis/index']],
            ['label' => "<span class='fas fa-user-plus'></span>
                        <span>&nbsp;Criar</span>", 'url' => ['/res/responsaveis/pesquisa']],
        ],
    ],
    /*[
        'options' => ['id' => 'agenda'],
        'label' => "<span class='fas fa-calendar-alt'></span>
          <span>&nbsp;Agendas</span>",
        'items' => [
            [
                'label' => "<span class='fas fa-list-ol'></span>
                        <span>&nbsp;Criar</span>",
                'url' => '', 'options' => ['id' => 'snwNavLinkVacanciesMonth'], 'linkOptions' => ['onClick' => 'snwNavLinkVacanciesMonth(event)',]
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-list'></span>
                        <span>&nbsp;Listar agendas</span>", 'url' => ['/agenda/agendas/index']],
            '<div class="dropdown-divider"></div>',
            ['label' => "<span class='fas fa-print'></span>
                        <span>&nbsp;Imp. Ag. do Dia</span>", 'url' => ['/agenda/agendas/print-schedule-day'], 'linkOptions' => ['target' => '_blank',]],
        ],
    ],*/
    ['label' => "<span class='fas fa-search-location'></span>
                <span>&nbsp;Cras</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkCras']],
    ['label' => "<span class='fas fa-project-diagram'></span>
                <span>&nbsp;Sistema</span>", 'url' => '', 'options' => ['id' => 'snwNavLinkSystem']],
    ['label' => "<span class='fas fa-user-circle fa-sm'></span>
                <span>&nbsp;Colaborador</span>", 'url' => ['/user/user/collaborator']],
    ['label' => "<span class='fas fa-at fa-sm'></span>
                <span>&nbsp;Contato</span>", 'url' => ['/site/contact']],
    ['label' => "<span class='fas fa-comment-dots fa-sm'></span>
                <span>&nbsp;Sobre</span>", 'url' => ['/site/about']],
];
