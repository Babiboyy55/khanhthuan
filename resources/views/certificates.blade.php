@extends('layouts.app')

@section('content')
@php
$title = 'Chứng chỉ hiệu chuẩn thiết bị';
@endphp

<section class="mx-auto w-full max-w-6xl px-5 py-16">
    <div class="space-y-4 max-w-4xl">
        <p class="text-sm uppercase tracking-[0.3em] text-black/50">Chứng chỉ</p>
        <h1 class="text-4xl md:text-5xl font-display">Chứng chỉ hiệu chuẩn thiết bị</h1>
        <p class="text-black/70">Trang này tập hợp các giấy chứng nhận hiệu chuẩn và minh chứng năng lực thiết bị, kiểm định của Công ty Khánh Thuận.</p>
    </div>

    <div class="mt-8 flex flex-wrap gap-3">
        <a href="#tye2000" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy thử nén TYE-2000</a>
        <a href="#we1000b" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy vạn năng WE-1000B</a>
        <a href="#mc100" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy thử nén uốn MC-100</a>
        <a href="#kichthuyluc1" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Kích thuỷ lực 1</a>
        <a href="#kichthuyluc2" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Kích thuỷ lực 2</a>
        <a href="#kqhc-06" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">KQ Hiệu chuẩn 06</a>
        <a href="#kichthuyluc3" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Kích thuỷ lực 3</a>
        <a href="#vongdoluc" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Vòng đo lực</a>
        <a href="#candientu1" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Cân đĩa điện tử (1)</a>
        <a href="#candientu2" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Cân đĩa điện tử (2)</a>
        <a href="#candientu3" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Cân đĩa điện tử (3)</a>
        <a href="#donghoso1" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Đồng hồ so (1)</a>
        <a href="#donghoso2" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Đồng hồ so (2)</a>
        <a href="#donghoso3" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Đồng hồ so (3)</a>
        <a href="#donghoso4" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Đồng hồ so (4)</a>
        <a href="#thietbithudodan" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Độ dãn dài nhựa đường</a>
        <a href="#candovong" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Cần đo võng Benkelman</a>
        <a href="#maycatdat" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy cắt đất</a>
        <a href="#maytamlien" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy tam liên</a>
        <a href="#apkeloxo" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Áp kế lò xo</a>
        <a href="#maydodientro" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy đo điện trở đất</a>
        <a href="#maynentamlien1" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy nén tam liên WG-1C</a>
        <a href="#maynentamlien2" class="rounded-full border border-black/15 bg-white px-5 py-2 font-semibold hover:bg-gray-50 transition-colors">Máy nén tam liên WG</a>
    </div>

    <div class="mt-10 space-y-8">

        <article id="tye2000" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy thử độ bền nén (Kiểu TYE - 2000)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 01.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/62.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy thử độ bền nén TYE-2000" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/63.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy thử độ bền nén TYE-2000" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="we1000b" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy thử độ bền kéo, nén, uốn (Kiểu WE - 1000B)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 02.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/64.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy WE-1000B" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/65.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy WE-1000B" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="mc100" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy thử độ bền nén, uốn (Kiểu MC - 100)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 03.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/66.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy MC-100" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/67.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy MC-100" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="kichthuyluc1" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Kích thuỷ lực (SĐH: 17121184823)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 04.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/68.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Kích thuỷ lực 04.037.25" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/69.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Kích thuỷ lực 04.037.25" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="kichthuyluc2" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Kích thuỷ lực (Số: N/A)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 05.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/70.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Kích thuỷ lực 05.037.25" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/71.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Kích thuỷ lực 05.037.25" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="kqhc-06" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Kết quả hiệu chuẩn (Số: 06.037.25)</h2>
            <p class="mt-3 text-black/70">Trang kết quả hiệu chuẩn số 06.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/73.jpg" alt="Trang 2 - Kết quả hiệu chuẩn 06.037.25" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="kichthuyluc3" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Kích thuỷ lực (Kiểu KN 200-150)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 07.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/74.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Kích thuỷ lực KN 200-150" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/75.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Kích thuỷ lực KN 200-150" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="vongdoluc" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Vòng đo lực (Kiểu Cơ)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 08.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/76.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Vòng đo lực" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/77.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Vòng đo lực" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="candientu1" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Cân đĩa điện tử (Kiểu GS-ALC15)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 09.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/78.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Cân đĩa điện tử GS-ALC15" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/79.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Cân đĩa điện tử GS-ALC15" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="candientu2" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Cân đĩa điện tử (Kiểu GS-HAW15)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 10.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/80.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Cân đĩa điện tử GS-HAW15" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/81.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Cân đĩa điện tử GS-HAW15" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="donghoso1" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Đồng hồ so (SĐH: 91213069)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 11.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/82.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Đồng hồ so 91213069" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/83.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Đồng hồ so 91213069" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="donghoso2" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Đồng hồ so (SĐH: 00112233)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 12.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/84.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Đồng hồ so 00112233" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/85.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Đồng hồ so 00112233" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="donghoso3" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Đồng hồ so (SĐH: 902812)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 13.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/86.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Đồng hồ so 902812" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/87.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Đồng hồ so 902812" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="donghoso4" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Đồng hồ so (SĐH: 902819)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 14.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/88.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Đồng hồ so 902819" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/89.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Đồng hồ so 902819" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="thietbithudodan" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Thiết bị thử độ dãn dài nhựa đường</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận kết quả đo, thử nghiệm số 15.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/90.jpg" alt="Trang 1 - Chứng nhận Thiết bị thử độ dãn dài nhựa đường" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/91.jpg" alt="Trang 2 - Kết quả đo Thiết bị thử độ dãn dài nhựa đường" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="candovong" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Cần đo võng Benkelman</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận kết quả đo, thử nghiệm số 16.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/92.jpg" alt="Trang 1 - Chứng nhận Cần đo võng Benkelman" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/93.jpg" alt="Trang 2 - Kết quả đo Cần đo võng Benkelman" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="maycatdat" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy cắt đất (Kiểu ZJ)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 17.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/94.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy cắt đất" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/95.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy cắt đất" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="maytamlien" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy tam liên (Kiểu WG)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 18.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/96.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy tam liên" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/97.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy tam liên" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="apkeloxo" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Áp kế lò xo (Máy thử thấm bê tông)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 19.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/98.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Áp kế lò xo" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/99.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Áp kế lò xo" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="maydodientro" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy đo điện trở đất (Kiểu 4105A)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận kết quả đo số 20.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/100.jpg" alt="Trang 1 - Chứng nhận đo Máy đo điện trở đất" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/101.jpg" alt="Trang 2 - Kết quả đo Máy đo điện trở đất" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="candientu3" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Cân đĩa điện tử (Kiểu ALC-15A)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 21.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/102.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Cân đĩa điện tử ALC-15A" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/103.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Cân đĩa điện tử ALC-15A" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="maynentamlien1" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy nén tam liên (Kiểu WG-1C)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 22.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/104.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy nén tam liên WG-1C" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/105.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy nén tam liên WG-1C" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

        <article id="maynentamlien2" class="rounded-3xl border border-black/10 bg-white p-6 shadow-soft scroll-mt-24">
            <h2 class="text-3xl font-display">Máy nén tam liên (Kiểu WG)</h2>
            <p class="mt-3 text-black/70">Giấy chứng nhận hiệu chuẩn số 23.037.25 cấp bởi Viện Khoa học Công nghệ Xây dựng.</p>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <img src="/images/106.jpg" alt="Trang 1 - Chứng nhận hiệu chuẩn Máy nén tam liên WG" class="rounded-2xl border border-black/10 object-cover w-full">
                <img src="/images/107.jpg" alt="Trang 2 - Kết quả hiệu chuẩn Máy nén tam liên WG" class="rounded-2xl border border-black/10 object-cover w-full">
            </div>
        </article>

    </div>
</section>

<button
    type="button"
    id="back-to-top"
    class="fixed bottom-6 right-6 z-50 hidden h-12 w-12 items-center justify-center rounded-full border border-black/20 bg-white/95 text-brand shadow-soft transition hover:-translate-y-0.5 hover:bg-white"
    aria-label="Cuộn lên đầu trang">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 3.5a1 1 0 0 1 .707.293l5 5a1 1 0 1 1-1.414 1.414L11 6.914V16a1 1 0 1 1-2 0V6.914L5.707 10.207a1 1 0 1 1-1.414-1.414l5-5A1 1 0 0 1 10 3.5Z" clip-rule="evenodd" />
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('back-to-top');

        if (!backToTopButton) {
            return;
        }

        const toggleBackToTopButton = function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('hidden');
                backToTopButton.classList.add('flex');
            } else {
                backToTopButton.classList.remove('flex');
                backToTopButton.classList.add('hidden');
            }
        };

        window.addEventListener('scroll', toggleBackToTopButton, {
            passive: true
        });
        toggleBackToTopButton();

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection