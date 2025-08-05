@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Prospek</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('prospek/list/page') }}">
                @csrf
                <!-- Section 1: Form Header -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="klaster" class="form-label fw-bold">Nama Klaster</label>
                        <select class="form-control @error('klaster') is-invalid @enderror" name="klaster" id="klaster">
                            <option value="">--Nama Klaster--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_hp" class="form-label fw-bold">Nomor Hp</label>
                        <input type="number" id="nomor_hp" name="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ditugaskan_ke" class="form-label fw-bold">Ditugaskan Ke</label>
                        <select class="form-control @error('ditugaskan_ke') is-invalid @enderror" name="ditugaskan_ke" id="ditugaskan_ke">
                            <option value="">--Ditugaskan Ke--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sumber_prospek" class="form-label fw-bold">Sumber Prospek</label>
                        <select class="form-control @error('sumber_prospek') is-invalid @enderror" name="sumber_prospek" id="sumber_prospek">
                            <option value="">--Sumber Prospek--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="warm_meter" class="form-label fw-bold">Warm Meter</label>
                        <select class="form-control @error('warm_meter') is-invalid @enderror" name="warm_meter" id="warm_meter">
                            <option value="">--Warm Meter--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tags</label>
                        <div class="form-control d-flex flex-wrap gap-2" id="tags-input">
                            <input type="text" id="tagInput" class="border-0 flex-grow-1" placeholder="Ketik lalu tekan Enter...">
                        </div>
                        <input type="hidden" name="tags" id="tagsHidden">
                    </div>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fa fa-check mr-2"></i>Simpan
                            </button>
                            <a href="{{ route('prospek/list/page') }}"
                               class="btn btn-primary float-left veiwbutton ml-3">
                                <i class="fas fa-chevron-left mr-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>

                <script>
                    const tagInput = document.getElementById('tagInput');
                    const tagContainer = document.getElementById('tags-input');
                    const tagsHidden = document.getElementById('tagsHidden');
                    const tags = [];

                    function updateHiddenInput() {
                        tagsHidden.value = tags.join(',');
                    }

                    function createTagElement(text) {
                        const tag = document.createElement('span');
                        tag.className = 'badge bg-light border text-dark d-flex align-items-center';
                        tag.style.gap = '0.5rem';

                        const span = document.createElement('span');
                        span.textContent = text;

                        const closeBtn = document.createElement('button');
                        closeBtn.type = 'button';
                        closeBtn.className = 'btn btn-sm btn-outline-danger py-0 px-1';
                        closeBtn.textContent = '×';
                        closeBtn.onclick = () => {
                            tags.splice(tags.indexOf(text), 1);
                            tag.remove();
                            updateHiddenInput();
                        };

                        tag.appendChild(span);
                        tag.appendChild(closeBtn);
                        return tag;
                    }

                    tagInput.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' && this.value.trim() !== '') {
                            e.preventDefault();
                            const newTag = this.value.trim();
                            if (!tags.includes(newTag)) {
                                tags.push(newTag);
                                const tagElement = createTagElement(newTag);
                                tagContainer.insertBefore(tagElement, tagInput);
                                updateHiddenInput();
                            }
                            this.value = '';
                        }
                    });
                </script>
            </form>
        </div>
    </div>
@endsection
