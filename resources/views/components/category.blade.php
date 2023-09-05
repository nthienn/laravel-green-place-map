<!-- Category -->
<div class="category">
    <ul class="category-list">
        <li class="category-item">
            <a href="{{ route('places-outstanding') }}" class="category-link">
                <i class="fa-solid fa-fire"></i>
                <span>Nổi bật</span>
            </a>
        </li>
        <li class="category-item">
            <a href="{{ route('places-type', ['name' => 'coffee', 'id' => 1]) }}" class="category-link">
                <i class="fa-solid fa-mug-hot"></i>
                <span>Quán Cafe</span>
            </a>
        </li>
        <li class="category-item">
            <a href="{{ route('places-type', ['name' => 'restaurant', 'id' => 2]) }}" class="category-link">
                <i class="fa-solid fa-utensils"></i>
                <span>Nhà hàng</span>
            </a>
        </li>
        <li class="category-item">
            <a href="{{ route('places-type', ['name' => 'travel', 'id' => 3]) }}" class="category-link">
                <i class="fa-solid fa-umbrella-beach"></i>
                <span>Khu du lịch</span>
            </a>
        </li>
    </ul>
</div>