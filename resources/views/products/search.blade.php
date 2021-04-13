<form action="{{ route('product.index') }}" method="GET">
    <div class="col-6">
        <div class="col-6">
          <label class="sr-only">product Name</label>
          <input type="text" class="form-control mb-2" name="product_name" placeholder="Product Name" value="{{ request()->get('product_name')  }}" >
        </div>
        <div class="col-6">
          {{-- <label class="sr-only">Category</label>
          <div class="input-group mb-2">
            <select id="inputState" class="form-control" name="category_id">
                <option value=""></option>
                @if(!empty($categories))
                        @foreach ($categories as $categoryId => $categoryName)
                            <option value="{{ $categoryId }}" {{ request()->get('category_id') == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>
                        @endforeach
                    @endif
              </select>
          </div> --}}
          <button type="submit" class="btn btn-primary mb-2">Search</button>      
        </div>
      </div>
    </form>