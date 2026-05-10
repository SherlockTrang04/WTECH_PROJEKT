<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <title>Elektroshop – Administrácia</title>
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f4f7f6; }
        .sidebar { height: 100vh; background: #28056d; color: white; position: fixed; width: 250px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; padding: 15px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background: #190442; color: white; border-left: 4px solid #f2f1f1; }
        .main-content { margin-left: 250px; padding: 30px; }
        .stat-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .logout-btn { color: #e74c3c !important; border-top: 1px solid rgba(255,255,255,0.1); }
        .product-img-preview { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 4px; background: #eee; }
    </style>
</head>
<body>

{{-- ── SIDEBAR ──────────────────────────────────────────── --}}
<div class="sidebar d-flex flex-column">
    <div class="p-4 text-center">
        <span class="text-white fw-bold fs-5">Elektroshop Admin</span>
    </div>
    <nav class="flex-grow-1">
        <a href="#" class="active">
            <i class="fa-solid fa-box me-2"></i> Produkty
        </a>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn btn btn-link w-100 text-start px-4 py-3" style="text-decoration:none;">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Odhlásiť sa
        </button>
    </form>
</div>

{{-- ── MAIN ─────────────────────────────────────────────── --}}
<div class="main-content">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Správa produktov</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fa-solid fa-plus me-2"></i>Nový produkt
        </button>
    </div>

    <div class="stat-card">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Názov</th>
                    <th>Kategória</th>
                    <th>Cena</th>
                    <th>Aktívny</th>
                    <th class="text-end">Akcie</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>
                        @foreach ($product->images->take(2) as $img)
                            <img src="{{ $img->url }}" class="product-img-preview" alt="">
                        @endforeach
                        @if ($product->images->isEmpty())
                            <span class="text-muted small">–</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <small class="text-muted">{{ Str::limit($product->description, 60) }}</small>
                    </td>
                    <td>
                        <small class="text-muted">{{ $product->category?->name ?? '–' }}</small>
                    </td>
                    <td>€{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->is_active)
                            <span class="badge bg-success">Áno</span>
                        @else
                            <span class="badge bg-secondary">Nie</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <button
                            class="btn btn-sm btn-outline-primary me-1"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-desc="{{ $product->description }}"
                            data-active="{{ $product->is_active ? '1' : '0' }}"
                            data-category="{{ $product->category_id }}"
                            data-brand="{{ $product->brand }}"
                            data-color="{{ $product->color }}"
                            data-stock="{{ $product->stock }}"
                            data-img1="{{ $product->images->get(0)?->image_url ?? '' }}"
                            data-img2="{{ $product->images->get(1)?->image_url ?? '' }}"
                        >
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                              class="d-inline"
                              onsubmit="return confirm('Naozaj chcete odstrániť tento produkt?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Žiadne produkty.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── CREATE MODAL ─────────────────────────────────────── --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pridať nový produkt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-8">
                            <label class="form-label">Názov produktu</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cena (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kategória</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Vybrať kategóriu --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sklad (ks)</label>
                            <input type="number" name="stock" class="form-control" min="0" value="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Značka</label>
                            <input type="text" name="brand" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Farba</label>
                            <input type="text" name="color" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Opis produktu</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hlavná fotografia</label>
                            <input type="file" name="img1" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vedľajšia fotografia</label>
                            <input type="file" name="img2" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="create-active" checked>
                                <label class="form-check-label" for="create-active">Aktívny produkt</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušiť</button>
                    <button type="submit" class="btn btn-success">Uložiť produkt</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── EDIT MODAL ───────────────────────────────────────── --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upraviť produkt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="editForm" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-8">
                            <label class="form-label">Názov produktu</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cena (€)</label>
                            <input type="number" step="0.01" name="price" id="edit-price" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kategória</label>
                            <select name="category_id" id="edit-category" class="form-select" required>
                                <option value="">-- Vybrať kategóriu --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sklad (ks)</label>
                            <input type="number" name="stock" id="edit-stock" class="form-control" min="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Značka</label>
                            <input type="text" name="brand" id="edit-brand" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Farba</label>
                            <input type="text" name="color" id="edit-color" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Opis produktu</label>
                            <textarea name="description" id="edit-desc" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hlavná fotografia</label>
                            <input type="hidden" name="existing_img1" id="edit-existing-img1">
                            <img id="edit-preview1" src="" alt="" class="product-img-preview mb-1" style="display:none;width:80px;height:80px;">
                            <input type="file" name="img1" id="edit-img1" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vedľajšia fotografia</label>
                            <input type="hidden" name="existing_img2" id="edit-existing-img2">
                            <img id="edit-preview2" src="" alt="" class="product-img-preview mb-1" style="display:none;width:80px;height:80px;">
                            <input type="file" name="img2" id="edit-img2" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit-active">
                                <label class="form-check-label" for="edit-active">Aktívny produkt</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušiť</button>
                    <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('editModal').addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;
        document.getElementById('edit-name').value      = btn.dataset.name;
        document.getElementById('edit-price').value     = btn.dataset.price;
        document.getElementById('edit-desc').value      = btn.dataset.desc;
        document.getElementById('edit-brand').value     = btn.dataset.brand;
        document.getElementById('edit-color').value     = btn.dataset.color;
        document.getElementById('edit-stock').value     = btn.dataset.stock;
        document.getElementById('edit-active').checked  = btn.dataset.active === '1';
        document.getElementById('edit-category').value  = btn.dataset.category;
        document.getElementById('editForm').action      = '/admin/products/' + btn.dataset.id;

        // Reset file inputs
        document.getElementById('edit-img1').value = '';
        document.getElementById('edit-img2').value = '';

        // Populate hidden existing URL fields and show previews
        ['img1', 'img2'].forEach(function (key, i) {
            const url      = btn.dataset[key];
            const hidden   = document.getElementById('edit-existing-' + key);
            const preview  = document.getElementById('edit-preview' + (i + 1));
            hidden.value   = url || '';
            if (url) {
                preview.src           = url;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>