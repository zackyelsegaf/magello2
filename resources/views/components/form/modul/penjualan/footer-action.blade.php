<div>
    <div id="footerActionBar"
        style="
    position: fixed;
    bottom: 0;
    z-index: 1030;
    background: #fff;
    width: 100%;
    padding: 12px 24px;
    box-shadow: 0 -2px 6px rgba(0,0,0,0.08);
    display: flex;
    justify-content: flex-start;
    align-items: center;
    transition: all 0.3s ease;
">
        <a href="{{ $routeCreate }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
        <button class="btn btn-secondary ml-2" onclick="toggleFilter()">
            <i class="fas fa-filter mr-1"></i>
            <span id="filterToggleText">Sembunyikan Filter</span>
        </button>
        <button id="deleteSelected" class="btn btn-danger ml-2">
            <i class="fas fa-trash mr-2"></i>Hapus
        </button>
    </div>
</div>
</div>
