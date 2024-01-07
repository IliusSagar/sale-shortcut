<ul class="list-group" style="margin-top: -20px; margin-bottom: 20px;">



    @forelse($products as $product)
    <a href="javascript::void(0)" onclick="testClick({{ json_encode($product) }})">
        <br>
        <li class="list-group-item" style="padding: 8px; margin-top: 30px;">

            <p style="">
                <strong>{{ $product->name }}</strong>
            </p>
        </li>
    </a>
    @empty
    <li style="color:red; padding: 0 20px; font-size: 18px;">Stock Out</li>
    @endforelse




</ul>