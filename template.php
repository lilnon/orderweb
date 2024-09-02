<?php
    include './layout/header.php';
    include './layout/footer.php';
?>

        <!-- <div class="navbar-center">
            <div class="avatar">
                <div class="w-40 mask mask-squircle">
                    <a href="index.html"><img
                            src="https://cdn.discordapp.com/attachments/1146683207694168176/1146683401148043284/327185835_1145911726127557_966502752968329274_n.jpg" /></a>
                </div>
            </div>
        </div> -->
    
    <div class="container mt-6 mx-auto">

        <div id="controls-carousel" class="mb-5 relative w-full" data-carousel="static" id="pic">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class=" duration-700 ease-in-out" data-carousel-item>
                    <img src="https://media.discordapp.net/attachments/1040169895909916702/1148087314178904095/1.png?width=1440&height=360"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="https://media.discordapp.net/attachments/1040169895909916702/1148087201842856086/2.png?width=1440&height=360"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://media.discordapp.net/attachments/1040169895909916702/1148087826722848829/3.png?width=1440&height=360"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://media.discordapp.net/attachments/1040169895909916702/1148089280024039435/4.png?width=1440&height=360"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        
        <div class="flex flex-col w-full border-opacity-50">
            
            <div class="grid h-20 card bg-base-300 rounded-box place-items-center">
                <center>
                🥩🥩🥩
                <br>
                ชาบูฟูล เป็นอีกร้านที่เพียงแค่สั่งชุดเริ่มต้น ที่เป็นชุดหมุก็คุ้มจุกๆ สามชั้นสไลด์คือดีงาม เป้นอีกร้านที่ชอบน้ำจิ้มของเค้ามาก อร่อย เปรี้ยว หวานลงตัว น้ำเดือดๆ เอาหมูสไลด์ลงไปสะบัดสองสามครั้งกินกับน้ำจิ้มซีฟู้ดอันที่พริกเยอะๆ มันฟิน 
                <br>

                📍ชาบูฟูล (ถนนโฉลกรัฐ ตรงข้ามซอยโฉลกรัฐ22/2)
                /📍ชาบูฟูล ภูธร8 (ทางไปสวนสาธารณะบึงขุนทะเล ติดมินิ บิ๊กซี)
                </div>
            </center>
            <div id="promotion" class="divider">เซตต่างๆ🍲</div>
           
               
          </div>
        <div class=" content-center grid grid-cols-3 gap-5" >
        
            <div class="flex justify-end"> 
                <div class="col-span-1 card w-96 bg-base-100 shadow-xl">
                    <div class="badge badge-secondary absolute" >โปรโมชั่น</div>
                    <img
                        src="https://scontent.fbkk22-6.fna.fbcdn.net/v/t39.30808-6/319829531_847936563191993_9107308195981042069_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=49d041&_nc_eui2=AeEbDpo7n6_caiwR0_S1z3Fw9XDHQnIVaQH1cMdCchVpATZ6g7nY81CPx4DV0BoL9mOxtKigzAIDw9k345MzaJDn&_nc_ohc=UFFjQgcraF4AX_rRrdf&_nc_zt=23&_nc_ht=scontent.fbkk22-6.fna&oh=00_AfB6OIlJInsOXNoS5yJZwf1CcyrVNYKr33geIe0grmFaPg&oe=64F93C81">
                    <div class="card-body">
                        <h2 class="card-title">เซต 1🥓🥬</h2>
                        <p>หมู + ผัก **รวมเครื่องดื่ม!</p>
                        <p>(ทานเหลือปรับ 100 บาท.)</p>
                        <h2 class="card-title">โปรโมชั่นวันแม่👨‍👩‍👦</h2>
                        <p>คุณแม่ อายุ 55-59 ราคา 12 บาท</p> 
                        <p>คุณแม่ อายุ 60 ปีขึ้นไป ฟรี !</p> 
                        <div class="card-actions justify-end">
                            <a  target="_blank" href="https://www.facebook.com/profile.php?id=100068662921541" class="w-32 btn base-100
                            ">
                                259</a>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="flex justify-center"> 
                <div class="col-span-1 card w-96 bg-base-100 shadow-xl">
                    <img
                        src="https://scontent.fbkk22-2.fna.fbcdn.net/v/t39.30808-6/319757645_812320896524820_9071940593610764863_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=49d041&_nc_eui2=AeEkD9h1b3o-Jm_tf3ysjoT_RitixmlcDgJGK2LGaVwOApX_M18R6hHdYhtKlcaytA4_8ouibObmbBnqnoZ5roET&_nc_ohc=6xiHM63Zse0AX9y7XFc&_nc_zt=23&_nc_ht=scontent.fbkk22-2.fna&oh=00_AfCy--7H6D2Uaq0TYT2d4UDLE3XQl2AEvkgiGmQlHJj2Tw&oe=64FABD46">
                    <div class="card-body">
                        <h2 class="card-title">เซต 2🦐🦀🦪</h2>
                        <p>หมู + ทะเล + ชีส   **รวมเครื่องดื่ม!</p>
                        <p>(ทานเหลือปรับ 100 บาท.)</p>
                        <div class="card-actions justify-end">
    
                            <a href="https://www.facebook.com/profile.php?id=100068662921541"
                            target="_blank" class="w-32 btn base-100                            ">299</a>
                                
                        </div>
                    </div>
                </div>
            </div>
  

            <div class="flex justify-start"> 
                <div class="col-span-1 card w-96 bg-base-100 shadow-xl">
                    <img
                        src="https://scontent.fbkk22-2.fna.fbcdn.net/v/t39.30808-6/318207801_1513679539138377_1767371016954879408_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=49d041&_nc_eui2=AeHuv9DJcuCxE0cItobKsEXoeJGuV37sTv94ka5XfuxO_9Dp-6jJqztdKUDVdrlm3O9iRT0J7o5DNSJHoZ7NbTcf&_nc_ohc=FQWz9KV91HkAX-fwmgl&_nc_zt=23&_nc_ht=scontent.fbkk22-2.fna&oh=00_AfBSItEl3tqXJPmaAnHvOZGeoCfIoLG2HOVMMDL_5VvqSg&oe=64F9532E">
                    <div class="card-body">
                        <h2 class="card-title">เซต 3🥩🧀</h2>
                        <p>หมู + ทะเล + ชีส + เนื้อ     **รวมเครื่องดื่ม!</p>
                        <p>(ทานเหลือปรับ 100 บาท.)</p>
                        <div class="card-actions justify-end " >
    
                            <a href="https://www.facebook.com/profile.php?id=100068662921541"
                                class="w-32 btn base-100                                "
                                target="_blank"
                                >319</a>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="flex flex-col w-full border-opacity-50">
            <div id="rules" class="divider">❌กฏในการทานของทางร้าน❌</div>
            
            <div class="grid grid-cols-2 gap-2 my-5">
                <div class="bg-base-300 rounded-box p-4">1. บุฟเฟต์ คือ การทานให้พอดี **จะมีการปรับ 100 บาท
                    <br>
                    2. บุฟเฟต์ บางครั้งก็คือการที่เราต้องบริการตัวเอง
                    <br>   
                    3. ทานไม่หมด จงยอมถูกปรับเสียแต่โดยดี 
                    <br></div>
                    <div class="bg-base-300 rounded-box p-4">
                        4. อย่านึกว่าการซ่อนของ/ขโมยของ ทางร้านจะไม่ทราบ บางร้านมีการติดตั้งกล้องวงจรปิด 
                        <br> 
                        5. อย่าแบ่งอาหารให้กับสัตว์
                        <br></div>
            </div>

 