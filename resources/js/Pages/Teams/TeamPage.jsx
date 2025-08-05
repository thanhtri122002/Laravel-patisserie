import HeroBanner from '../../Components/HeroBanner';
import TeamMembers from './Components/TeamMembers';
export default function TeamPage () {
    return (

        <>
            <HeroBanner 
                title='Meet our team' 
                subtitle='Our dedicated team of pastry chefs and artisans pour their passion into every creation, bringing you the finest treats with love and expertise!'
            >
            </HeroBanner>

            <section className="w-full">
                <div className="w-full bg-[--Gray-Tertiary]">
                    <p className="font-mer text-body text-center w-[40%] mx-auto py-10">
                    Behind every dessert we create is a team of passionate artisans devoted to the art of patisserie. Blending tradition with creativity, our chefs craft each pastry with care, precision, and a touch of imagination. Every layer, flavor, and finish reflects our dedication to excellence. Meet the people who transform simple ingredients into unforgettable moments of sweetness.
                    </p>
                </div>
            </section>

            <section className='w-full relative'>
                <TeamMembers></TeamMembers>
            </section>
        </>
        

        

    )
}