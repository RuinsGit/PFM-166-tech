@extends('back.layouts.master')

@section('title', 'Galeri Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Galeri Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.galleries.index') }}">Qalereya</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('back.pages.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Image Upload Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil</label>
                                    <input type="file" name="main_image" class="form-control @error('main_image') is-invalid @enderror">
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($gallery->main_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($gallery->main_image) }}" alt="" class="img-fluid" style="max-height: 100px">
                                        </div>
                                    @endif
                                </div>
                                    </div>
                                    <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alt Şəkillər</label>
                                            <div id="bottom-images-container">
                                                <div class="input-group mb-2">
                                                    <input type="file" name="bottom_images[]" class="form-control">
                                                    <button type="button" class="btn btn-danger" onclick="removeBottomImage(this)">Sil</button>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-warning" onclick="addBottomImage()">Yeni Şəkil Əlavə Et</button>
                                            </div>
                                            @if($gallery->bottom_images)
                                                <div class="mt-2">
                                                    @foreach(json_decode($gallery->bottom_images) as $image)
                                                        <img src="{{ asset($image) }}" alt="" class="img-fluid me-2" style="max-height: 100px">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Başlıq</label>
                                            <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ $gallery->title_az }}" required>
                                            @error('title_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil ALT</label>
                                            <input type="text" name="main_image_alt_az" class="form-control @error('main_image_alt_az') is-invalid @enderror" value="{{ $gallery->main_image_alt_az }}" required>
                                            @error('main_image_alt_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alt Şəkillər ALT</label>
                                            <div id="bottom-images-alt-container-az">
                                                @if($gallery->bottom_images_alt_az)
                                                    @foreach(json_decode($gallery->bottom_images_alt_az) as $alt)
                                                        <input type="text" name="bottom_images_alt_az[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT mətni">
                                                    @endforeach
                                                @else
                                                    <input type="text" name="bottom_images_alt_az[]" class="form-control mb-2" placeholder="ALT mətni">
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-warning mt-2" onclick="addBottomImageAlt('az')">Yeni ALT Mətn Əlavə Et</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Başlıq</label>
                                            <input type="text" name="meta_title_az" class="form-control" value="{{ $gallery->meta_title_az }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Məzmun</label>
                                            <textarea name="meta_description_az" class="form-control">{{ $gallery->meta_description_az }}</textarea>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ $gallery->title_en }}" required>
                                            @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Main Image ALT</label>
                                            <input type="text" name="main_image_alt_en" class="form-control @error('main_image_alt_en') is-invalid @enderror" value="{{ $gallery->main_image_alt_en }}" required>
                                            @error('main_image_alt_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bottom Images ALT</label>
                                            <div id="bottom-images-alt-container-en">
                                                @if($gallery->bottom_images_alt_en)
                                                    @foreach(json_decode($gallery->bottom_images_alt_en) as $alt)
                                                        <input type="text" name="bottom_images_alt_en[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT text">
                                                    @endforeach
                                                @else
                                                    <input type="text" name="bottom_images_alt_en[]" class="form-control mb-2" placeholder="ALT text">
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-warning mt-2" onclick="addBottomImageAlt('en')">Add New ALT Text</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title_en" class="form-control" value="{{ $gallery->meta_title_en }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description_en" class="form-control">{{ $gallery->meta_description_en }}</textarea>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок</label>
                                            <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ $gallery->title_ru }}" required>
                                            @error('title_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ALT главного изображения</label>
                                            <input type="text" name="main_image_alt_ru" class="form-control @error('main_image_alt_ru') is-invalid @enderror" value="{{ $gallery->main_image_alt_ru }}" required>
                                            @error('main_image_alt_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ALT нижних изображений</label>
                                            <div id="bottom-images-alt-container-ru">
                                                @if($gallery->bottom_images_alt_ru)
                                                    @foreach(json_decode($gallery->bottom_images_alt_ru) as $alt)
                                                        <input type="text" name="bottom_images_alt_ru[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT текст">
                                                    @endforeach
                                                @else
                                                    <input type="text" name="bottom_images_alt_ru[]" class="form-control mb-2" placeholder="ALT текст">
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-warning mt-2" onclick="addBottomImageAlt('ru')">Добавить новый ALT текст</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-заголовок</label>
                                            <input type="text" name="meta_title_ru" class="form-control" value="{{ $gallery->meta_title_ru }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-описание</label>
                                            <textarea name="meta_description_ru" class="form-control">{{ $gallery->meta_description_ru }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Qalereya Tipi</label>
                                    <select name="gallery_type_id" class="form-control @error('gallery_type_id') is-invalid @enderror" required>
                                        <option value="">Qalereya tipi seçin</option>
                                        @foreach($galleryTypes as $type)
                                            <option value="{{ $type->id }}" {{ $gallery->gallery_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->title_az }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gallery_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.galleries.index') }}" class="btn btn-secondary">Ləğv et</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addBottomImage() {
            const container = document.getElementById('bottom-images-container');
            const wrapper = document.createElement('div');
            wrapper.className = 'input-group mb-2';
            
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'bottom_images[]';
            input.className = 'form-control';
            
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'btn btn-danger';
            button.onclick = function() { removeBottomImage(this); };
            button.textContent = 'Sil';
            
            wrapper.appendChild(input);
            wrapper.appendChild(button);
            container.appendChild(wrapper);
        }

        function removeBottomImage(button) {
            const wrapper = button.closest('.input-group');
            if (wrapper) {
                wrapper.remove();
            }
        }

        function addBottomImageAlt(lang) {
            const container = document.getElementById(`bottom-images-alt-container-${lang}`);
            const input = document.createElement('input');
            input.type = 'text';
            input.name = `bottom_images_alt_${lang}[]`;
            input.className = 'form-control mb-2';
            input.placeholder = lang === 'ru' ? 'ALT текст' : (lang === 'en' ? 'ALT text' : 'ALT mətni');
            container.appendChild(input);
        }
    </script>
@endsection 