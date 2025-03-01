<style>
    .container-slide {
        margin: 0 auto;
        margin-bottom:10px;
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .slider-container {
            position: relative;
            margin: 20px 0;
        }
        
        .slider {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 10px;
            padding: 10px 0;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
        }
        
        .slider::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        
        .slide {
            flex: 0 0 auto;
            width: 300px;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .slide:hover {
            transform: scale(1.02);
        }
        
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .slide-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            font-size: 14px;
        }
        
        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: none;
            font-size: 20px;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        .nav-button:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .prev {
            left: 10px;
        }
        
        .next {
            right: 10px;
        }
        
        .dots-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .dot.active {
            background-color: #555;
        }
        
        @media (max-width: 768px) {
            .slide {
                width: 250px;
                height: 180px;
            }
        }
        
        @media (max-width: 480px) {
            .slide {
                width: 200px;
                height: 150px;
            }
        }
    }
</style>
<div class="container-slide">
    <div class="slider-container">
        <button class="nav-button prev">❮</button>
        <div class="slider" id="slider">
            <? foreach($posts["data"] as $key => $post){ ?>
                <div class="slide">
                    <img src="/get/image?img=/post/<?= htmlspecialchars(($post["image"])??"") ?>" alt="<?= htmlspecialchars(($post["image"])??"") ?>">
                    <div class="slide-caption">วันที่รับสมัคร <?= htmlspecialchars($post["p_date_start"]." - ".$post["p_date_end"]) ?></div>
                </div>
            <? } ?>
        </div>
        <button class="nav-button next">❯</button>
    </div>
    
    <div class="dots-container" id="dots-container"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('.slide');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        const dotsContainer = document.getElementById('dots-container');
        
        // สร้างจุดนำทาง
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                goToSlide(index);
            });
            dotsContainer.appendChild(dot);
        });
        
        const dots = document.querySelectorAll('.dot');
        
        // จัดการปุ่มเลื่อนไปข้างหน้า
        nextButton.addEventListener('click', () => {
            slider.scrollLeft += 310; // ขนาดของสไลด์บวกช่องว่าง
            updateDots();
        });
        
        // จัดการปุ่มเลื่อนไปข้างหลัง
        prevButton.addEventListener('click', () => {
            slider.scrollLeft -= 310; // ขนาดของสไลด์บวกช่องว่าง
            updateDots();
        });
        
        // เลื่อนไปยังสไลด์ที่ต้องการ
        function goToSlide(index) {
            const slideWidth = slides[0].offsetWidth;
            const slideMargin = 10; // ช่องว่างระหว่างสไลด์
            const scrollPosition = index * (slideWidth + slideMargin);
            
            slider.scrollLeft = scrollPosition;
            updateActiveDot(index);
        }
        
        // อัพเดทจุดนำทางตามตำแหน่งการเลื่อน
        function updateDots() {
            const slideWidth = slides[0].offsetWidth;
            const slideMargin = 10;
            const scrollPosition = slider.scrollLeft;
            const activeIndex = Math.round(scrollPosition / (slideWidth + slideMargin));
            
            updateActiveDot(activeIndex);
        }
        
        // อัพเดทสถานะจุดที่กำลังใช้งาน
        function updateActiveDot(index) {
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
        
        // ตรวจจับการเลื่อนด้วยเมาส์หรือการกด
        slider.addEventListener('scroll', () => {
            updateDots();
        });
    });
</script>