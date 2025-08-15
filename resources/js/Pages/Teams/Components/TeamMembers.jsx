import { div } from "motion/react-client";

export default function TeamMembers (className, children, ...props) {

    return (
        <div className="container mx-auto mt-[3rem]">
            <div className="flex flex-col gap-y-5 md:flex-row md:justify-evenly">
                <p className="font-mer text-h1 md:w-[40%]">Meet the talented chef <br /> who make all this happen</p>
                <p className="font-mer text-body md:w-[35%]">Each member of our team brings their own unique flair and expertise to the kitchen—from crafting delicate pastries to innovating bold new flavors. With a shared passion for excellence, our chefs work side by side to create moments of joy in every bite.</p>
            </div>
            <div className="grid grid-rows-2 md:grid-rows-1 md:grid-cols-4 gap-4 mt-5">
                <div class="our-team relative">
                    <div class="picture">
                        <img src="" alt="" />
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="" alt="" />
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="" alt="" />
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
                <div class="our-team relative">
                    <div class="picture">
                        <img src="" alt="" />
                    </div>
                    <div class="member">
                        <p>Tri Thanh</p>
                        <p>CEO</p>
                    </div>
                    <div class="social flex justify-center items-center">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div>
            </div>
        </div>
    )


}