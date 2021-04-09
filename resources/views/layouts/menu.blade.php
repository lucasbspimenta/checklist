<div class="flex flex-col mt-2 md:flex-row md:mt-0 md:mx-1 md:h-full bg-white bg-opacity-90">
    <x-header.menuitem nome='Painel' nomerota='index' icone='chalkboard' badge=''/>
    <x-header.menuitem nome='Agenda' nomerota='agenda' icone='calendar-alt' badge=''/>
    <x-header.menuitem nome='Checklist' nomerota='index' icone='clipboard-check' badge=''/>
    <x-header.menuitem nome='Administração' nomerota='index' icone='cogs' badge=''>
        <x-header.menusubitem nome='Tipos de Agendamento' descricao='Inclusão e alteração dos tipos de atendimentos' nomerota="adm.tipodeagendamento"  icone='calendar-day' badge=''/>
        <x-header.menusubitem nome='Itens do Checklist' descricao='Inclusão e alteração dos itens do checklist' nomerota='adm.checklist' icone='list-alt' badge=''/>
    </x-header.menuitem>
</div>