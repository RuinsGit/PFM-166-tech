@extends('back.layouts.master')

@section('title', 'Portfolio Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Portfolio Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('back.pages.portfolio.index') }}">Portfolio</a></li>
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
                            <form action="{{ route('back.pages.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
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
                                            @if($portfolio->main_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($portfolio->main_image) }}" alt="" class="img-fluid" style="max-height: 100px">
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
                                            @if($portfolio->bottom_images)
                                                <div class="mt-2">
                                                    @foreach(json_decode($portfolio->bottom_images) as $image)
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
                                            <input type="text" name="title_az" class="form-control @error('title_az') is-invalid @enderror" value="{{ $portfolio->title_az }}" required>
                                            @error('title_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Əsas Şəkil ALT</label>
                                            <input type="text" name="main_image_alt_az" class="form-control @error('main_image_alt_az') is-invalid @enderror" value="{{ $portfolio->main_image_alt_az }}" required>
                                            @error('main_image_alt_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alt Şəkillər ALT</label>
                                            <div id="bottom-images-alt-container-az">
                                                @if($portfolio->bottom_images_alt_az)
                                                    @foreach(json_decode($portfolio->bottom_images_alt_az) as $alt)
                                                        <input type="text" name="bottom_images_alt_az[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT mətni">
                                                    @endforeach
                                                @endif
                                                <input type="text" name="bottom_images_alt_az[]" class="form-control mb-2" placeholder="ALT mətni">
                                            </div>
                                            <button type="button" class="btn btn-warning mt-2" onclick="addBottomImageAlt('az')">Yeni ALT Mətn Əlavə Et</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Məzmun</label>
                                            <textarea name="description_az" class="form-control @error('description_az') is-invalid @enderror" required>{{ $portfolio->description_az }}</textarea>
                                            @error('description_az')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Başlıq</label>
                                            <input type="text" name="meta_title_az" class="form-control" value="{{ $portfolio->meta_title_az }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Məzmun</label>
                                            <textarea name="meta_description_az" class="form-control">{{ $portfolio->meta_description_az }}</textarea>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ $portfolio->title_en }}" required>
                                            @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Main Image ALT</label>
                                            <input type="text" name="main_image_alt_en" class="form-control @error('main_image_alt_en') is-invalid @enderror" value="{{ $portfolio->main_image_alt_en }}" required>
                                            @error('main_image_alt_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bottom Images ALT</label>
                                            <div id="bottom-images-alt-container-en">
                                                @if($portfolio->bottom_images_alt_en)
                                                    @foreach(json_decode($portfolio->bottom_images_alt_en) as $alt)
                                                        <input type="text" name="bottom_images_alt_en[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT text">
                                                    @endforeach
                                                @endif
                                                <input type="text" name="bottom_images_alt_en[]" class="form-control mb-2" placeholder="ALT text">
                                            </div>
                                            <button type="button" class="btn btn-secondary mt-2" onclick="addBottomImageAlt('en')">Add New ALT Text</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" required>{{ $portfolio->description_en }}</textarea>
                                            @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title_en" class="form-control" value="{{ $portfolio->meta_title_en }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description_en" class="form-control">{{ $portfolio->meta_description_en }}</textarea>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Заголовок</label>
                                            <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror" value="{{ $portfolio->title_ru }}" required>
                                            @error('title_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ALT главного изображения</label>
                                            <input type="text" name="main_image_alt_ru" class="form-control @error('main_image_alt_ru') is-invalid @enderror" value="{{ $portfolio->main_image_alt_ru }}" required>
                                            @error('main_image_alt_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ALT нижних изображений</label>
                                            <div id="bottom-images-alt-container-ru">
                                                @if($portfolio->bottom_images_alt_ru)
                                                    @foreach(json_decode($portfolio->bottom_images_alt_ru) as $alt)
                                                        <input type="text" name="bottom_images_alt_ru[]" class="form-control mb-2" value="{{ $alt }}" placeholder="ALT текст">
                                                    @endforeach
                                                @endif
                                                <input type="text" name="bottom_images_alt_ru[]" class="form-control mb-2" placeholder="ALT текст">
                                            </div>
                                            <button type="button" class="btn btn-secondary mt-2" onclick="addBottomImageAlt('ru')">Добавить новый ALT текст</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Описание</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" required>{{ $portfolio->description_ru }}</textarea>
                                            @error('description_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-заголовок</label>
                                            <input type="text" name="meta_title_ru" class="form-control" value="{{ $portfolio->meta_title_ru }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Мета-описание</label>
                                            <textarea name="meta_description_ru" class="form-control">{{ $portfolio->meta_description_ru }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Portfolio Tipi</label>
                                    <select name="portfolio_type_id" class="form-control @error('portfolio_type_id') is-invalid @enderror" required>
                                        <option value="">Portfolio tipi seçin</option>
                                        @foreach($portfolioTypes as $type)
                                            <option value="{{ $type->id }}" {{ $portfolio->portfolio_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->title_az }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('portfolio_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('back.pages.portfolio.index') }}" class="btn btn-secondary">Ləğv et</a>
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
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'bottom_images[]';
            input.className = 'form-control mb-2';
            container.appendChild(input);
        }

        function removeLastBottomImage() {
            const container = document.getElementById('bottom-images-container');
            const inputs = container.getElementsByTagName('input');
            if (inputs.length > 0) {
                container.removeChild(inputs[inputs.length - 1]);
            }
        }

        function addBottomImageAlt(lang) {
            const container = document.getElementById(`bottom-images-alt-container-${lang}`);
            const input = document.createElement('input');
            input.type = 'text';
            input.name = `bottom_images_alt_${lang}[]`;
            input.className = 'form-control mb-2';
            input.placeholder = lang === 'ru' ? 'ALT текст' : (lang === 'en' ? 'ALT text' : 'ALT metni');
            container.appendChild(input);
        }
    </script>
@endsection 