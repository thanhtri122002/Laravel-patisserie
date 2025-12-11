import HeroBanner from '../../Components/HeroBanner';
import TeamMembers from './Components/TeamMembers';
import QuoteSlider from './Components/QuoteSlider';
/**
 * TeamPage
 * 
 * @component
 * 
 * A component representing the team page which include others components which presenting others dynamic section
 * 
 * @returns {JSX.Element}
 */
export default function TeamPage() {
    return (

        <>
            <HeroBanner
                title='Meet our team'
                subtitle='Our dedicated team of pastry chefs and artisans pour their passion into every creation, bringing you the finest treats with love and expertise!'
            />

            <section className="w-full">
                <div className="w-full bg-[--Gray-Tertiary]">
                    <p className="font-mer text-body text-center w-[40%] mx-auto py-10">
                        Behind every dessert we create is a team of passionate artisans devoted to the art of patisserie. Blending tradition with creativity, our chefs craft each pastry with care, precision, and a touch of imagination. Every layer, flavor, and finish reflects our dedication to excellence. Meet the people who transform simple ingredients into unforgettable moments of sweetness.
                    </p>
                </div>
            </section>

            <section className='w-full relative'>
                <TeamMembers />
            </section>

            <p className="text-center text-h3 text-[--Pink-Primary] mt-12 max-w-[80%] mx-auto">
                "Each of us brings something unique to the table, but our goal is the same—creating joyful moments, one dessert at a time."
            </p>
            <QuoteSlider />
        </>
    )
}