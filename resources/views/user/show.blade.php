<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品の詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">
                        <div class="md:w-1/2">
                            <!-- Slider main container -->
                            <div class="swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        @if ($product->imageFirst->filename !== null)
                                            <img
                                                src="{{ $product->imageFirst->filename }}">
                                        @else
                                            <img src="https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/no_image.jpg">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if (optional($product->imageSecond)->filename !== null)
                                            <img
                                                src="{{ $product->imageSecond->filename }}">
                                        @else
                                            <img src="https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/no_image.jpg">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if (optional($product->imageThird)->filename !== null)
                                            <img
                                                src="{{  $product->imageThird->filename }}">
                                        @else
                                            <img src="https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/no_image.jpg">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if (optional($product->imageFourth)->filename !== null)
                                            <img
                                                src="{{ $product->imageFourth->filename }}">
                                        @else
                                            <img src="https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/no_image.jpg">
                                        @endif
                                    </div>
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                        <div class="md:w-1/2 ml-4">
                            <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">
                                {{ $product->category->name }}</h2>
                            <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                            <div class="flex justify-around items-center">
                                <div>
                                    <span
                                        class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}</span><span
                                        class="text-sm text-gray-700">円(税込み)</span>
                                </div>
                                <form method="post" action="{{ route('user.cart.add') }}">
                                    @csrf
                                    <div class="flex items-center">
                                        <span class="mr-3">数量</span>
                                        <div class="relative">
                                            <select name="quantity"
                                                class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                                @for ($i = 1; $i <= $quantity; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <button
                                        class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                                        <input type="hidden" name="product_id" value="{{ $product->id}}">
                                </form>
                                <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                                @if($product->is_liked_by_auth_user())
                                <!-- 「いいね」取消用ボタンを表示 -->
                                <form method="post" action="{{ route('user.unlike', ['item' => $product->id ])}}"> 
                                @csrf
                                <button class="p-0 border-0 inline-flex items-center justify-center text-red-500 ml-4">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                      <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                    </svg>
                                </button>
                                <input type="hidden" name="product_id" value="{{ $product->id}}">
                                </form>
                                @else
                                <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                <form method="post" action="{{ route('user.like', ['item' => $product->id ])}}">
                                @csrf
                                <button class="p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                      <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                    </svg>
                                </button>
                                <input type="hidden" name="product_id" value="{{ $product->id}}">
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-400 my-8"></div>
                    <div class="mb-4 text-center">この商品を販売しているショップ</div>
                    <div class="mb-4 text-center">{{ $product->shop->name }}</div>
                    <div class="mx-auto mb-4 text-center">
                        @if ($product->shop->filename !== null)
                            <img class="mx-auto w-40 h-40 object-cover rounded-full"
                                src="{{ $product->shop->filename }}">
                        @else
                            <img src="https://watasho-bucket.s3.ap-northeast-1.amazonaws.com/no_image.jpg">
                        @endif
                    </div>
                    <div class="mb-4 text-center"><button type="button" data-micromodal-trigger="modal-1"
                            href='javascript:;'
                            class="text-white bg-gray-400 border-0 py-2 px-6 focus:outline-none hover:bg-gray-500 rounded">ショップの詳細を見る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="text-x1 text-gray-700" id="modal-1-title">
                        {{ $product->shop->name }}
                    </h2>
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <p>
                        {{ $product->shop->information }}
                    </p>
                </main>
                <footer class="modal__footer">
                    <button type="button" class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">閉じる</button>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>
