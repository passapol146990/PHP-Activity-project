<style>
        .slideshow-container {
            position: relative;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden; /* ป้องกันการเลื่อนออกนอกพื้นที่ */
        }

        .slides {
            display: flex;
            overflow: hidden;
            position: relative;
            border-radius: 4px;
            transition: transform 0.8s cubic-bezier(0.45, 0, 0.55, 1); /* ปรับแต่งการเคลื่อนไหวให้สมูทขึ้น */
            will-change: transform; /* เพิ่มประสิทธิภาพการเรนเดอร์ */
        }

        .slide {
            min-width: 100%;
            height: 200px;
            background-color: #f8b3b3;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: opacity 0.4s ease; /* เพิ่มเอฟเฟกต์การเฟดในและเฟดเอาท์ */
            opacity: 0.8; /* เริ่มต้นที่ความโปร่งใสเล็กน้อย */
        }

        .slide.active {
            opacity: 1; /* สไลด์ที่กำลังแสดงจะมีความทึบสูงสุด */
        }

        .slide-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .date {
            font-size: 16px;
            font-weight: bold;
            transform: translateY(-10px); /* เตรียมพร้อมสำหรับ animation */
            opacity: 0;
            animation: slideUp 0.6s forwards;
            animation-delay: 0.2s;
        }

        .count {
            font-size: 16px;
            font-weight: bold;
            transform: translateY(-10px);
            opacity: 0;
            animation: slideUp 0.6s forwards;
            animation-delay: 0.3s;
        }

        .slide-content {
            text-align: right;
            margin-top: 20px;
            transform: translateY(10px);
            opacity: 0;
            animation: slideUp 0.6s forwards;
            animation-delay: 0.4s;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .navigation-buttons {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            z-index: 10;
        }

        .prev, .next {
            cursor: pointer;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            user-select: none;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            transition: all 0.3s ease; /* เพิ่มการเปลี่ยนแปลงเมื่อ hover */
            opacity: 0.7;
        }

        .prev:hover, .next:hover {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 1;
        }

        .prev {
            margin-left: 10px;
            transform: translateY(-50%) translateX(-5px); /* เพิ่มเอฟเฟกต์เมื่อแสดง */
            animation: slideInLeft 0.5s forwards;
        }

        .next {
            margin-right: 10px;
            transform: translateY(-50%) translateX(5px);
            animation: slideInRight 0.5s forwards;
        }

        @keyframes slideInLeft {
            to {
                transform: translateY(-50%) translateX(0);
            }
        }

        @keyframes slideInRight {
            to {
                transform: translateY(-50%) translateX(0);
            }
        }

        .indicators {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .indicator {
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background-color: #d9d9d9;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.4s ease; /* การเปลี่ยนแปลงเมื่อมีการเปลี่ยนสถานะ */
            transform: scale(0.8); /* เริ่มต้นขนาดเล็กกว่าเล็กน้อย */
            opacity: 0;
            animation: fadeIn 0.5s forwards;
            animation-delay: calc(0.1s * var(--i, 0));
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .indicator.active {
            background-color: #ff5252;
            transform: scale(1.2); /* ขยายเมื่อเป็น active */
            box-shadow: 0 0 5px rgba(255, 82, 82, 0.5);
        }

        .indicator:hover {
            transform: scale(1.1);
            background-color: #ff8c8c;
        }
</style>
<div class="slideshow-container">
    <div class="slides" id="slides">
        <div class="slide">
            <div class="slide-header">
                <div class="date">รับสมัคร 10 - 15 กุมภาพันธ์ 2568</div>
                <div class="count">5/15</div>
            </div>
            <div class="slide-content">
                <!-- สามารถใส่เนื้อหาหรือรูปภาพเพิ่มเติมตรงนี้ -->
            </div>
        </div>
        <div class="slide">
            <div class="slide-header">
                <div class="date">รับสมัคร 10 - 15 กุมภาพันธ์ 2568</div>
                <div class="count">5/15</div>
            </div>
            <div class="slide-content">
                <!-- สามารถใส่เนื้อหาหรือรูปภาพเพิ่มเติมตรงนี้ -->
            </div>
        </div>
        <div class="slide">
            <div class="slide-header">
                <div class="date">รับสมัคร 10 - 15 กุมภาพันธ์ 2568</div>
                <div class="count">5/15</div>
            </div>
            <div class="slide-content">
                <!-- สามารถใส่เนื้อหาหรือรูปภาพเพิ่มเติมตรงนี้ -->
            </div>
        </div>
        <div class="slide">
            <div class="slide-header">
                <div class="date">รับสมัคร 20 - 22 กุมภาพันธ์ 2568</div>
                <div class="count">10/30</div>
            </div>
            <div class="slide-content">
                <div>ภาพเลื่อนกิจกรรมที่ 2</div>
            </div>
        </div>
        <div class="slide">
            <div class="slide-header">
                <div class="date">รับสมัคร 25 - 28 กุมภาพันธ์ 2568</div>
                <div class="count">7/20</div>
            </div>
            <div class="slide-content">
                <div>ภาพเลื่อนกิจกรรมที่ 3</div>
            </div>
        </div>
    </div>

    <div class="navigation-buttons">
        <button class="prev" onclick="changeSlide(-1)">❮</button>
        <button class="next" onclick="changeSlide(1)">❯</button>
    </div>

    <div class="indicators" id="indicators">
        <!-- จะถูกสร้างโดย JavaScript -->
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const slidesContainer = document.getElementById('slides');
    const indicatorsContainer = document.getElementById('indicators');
    let autoSlideInterval;
    let isAnimating = false; // ป้องกันการคลิกหลายครั้งระหว่างการเปลี่ยนสไลด์

    // สร้าง indicators ตามจำนวนสไลด์
    function createIndicators() {
        for (let i = 0; i < slides.length; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'indicator';
            indicator.style.setProperty('--i', i); // ตั้งค่าตัวแปร CSS สำหรับ animation delay
            if (i === currentSlide) {
                indicator.classList.add('active');
            }
            indicator.onclick = function() {
                if (!isAnimating) {
                    goToSlide(i);
                }
            };
            indicatorsContainer.appendChild(indicator);
        }
    }

    // แสดงสไลด์ตามตำแหน่งที่กำหนด
    function showSlides() {
        isAnimating = true; // เริ่มการเปลี่ยนสไลด์
        
        // ปรับปรุงสถานะของสไลด์
        slides.forEach((slide, index) => {
            if (index === currentSlide) {
                slide.classList.add('active');
                
                // รีเซ็ต animation สำหรับองค์ประกอบในสไลด์ที่กำลังแสดง
                const elements = slide.querySelectorAll('.date, .count, .slide-content');
                elements.forEach(el => {
                    el.style.animation = 'none';
                    el.offsetHeight; // trigger reflow
                    el.style.animation = '';
                });
            } else {
                slide.classList.remove('active');
            }
        });
        
        // เปลี่ยนตำแหน่งของ slider container
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // อัปเดต indicators
        const indicators = document.querySelectorAll('.indicator');
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });
        
        // รอให้การเปลี่ยนสไลด์เสร็จสิ้นก่อนที่จะอนุญาตให้เปลี่ยนสไลด์อีกครั้ง
        setTimeout(() => {
            isAnimating = false;
        }, 800); // ระยะเวลาเท่ากับการ transition ของ slides
    }

    // เปลี่ยนสไลด์
    function changeSlide(direction) {
        if (isAnimating) return; // ไม่อนุญาตให้เปลี่ยนหากกำลังมีการเปลี่ยนสไลด์อยู่
        
        resetAutoSlide();
        currentSlide += direction;
        
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        } else if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        
        showSlides();
    }

    // ไปยังสไลด์ที่ต้องการโดยตรง
    function goToSlide(slideIndex) {
        if (isAnimating) return; // ไม่อนุญาตให้เปลี่ยนหากกำลังมีการเปลี่ยนสไลด์อยู่
        
        resetAutoSlide();
        currentSlide = slideIndex;
        showSlides();
    }

    // เริ่มการสไลด์อัตโนมัติ
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            if (!isAnimating) {
                changeSlide(1);
            }
        }, 5000); // เปลี่ยนสไลด์ทุก 5 วินาที
    }

    // รีเซ็ตการสไลด์อัตโนมัติ
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // การโหลดเริ่มต้น
    function init() {
        createIndicators();
        
        // ตั้งค่าสไลด์แรกให้เป็น active
        slides[currentSlide].classList.add('active');
        
        showSlides();
        startAutoSlide();

        // หยุดการสไลด์อัตโนมัติเมื่อเม้าส์อยู่เหนือสไลด์
        slidesContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });

        // เริ่มการสไลด์อัตโนมัติเมื่อเม้าส์ออกจากสไลด์
        slidesContainer.addEventListener('mouseleave', startAutoSlide);
    }

    // เริ่มต้นทำงาน
    window.addEventListener('DOMContentLoaded', init);
</script>