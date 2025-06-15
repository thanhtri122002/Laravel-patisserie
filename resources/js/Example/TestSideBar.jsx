import SideBar from "../Components/SIdeBarNavigation";
import react from "react";

export default function ExampleSideBar() {
    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold mb-4">
                SideBar Navigation example
            </h1>
            <SideBar>
                <SideBar.Trigger className="burger-menu ml-auto">
                    <span className="line"></span>
                    <span className="line"></span>
                    <span className="line"></span>
                    
                </SideBar.Trigger>
                
                <SideBar.Content>
                    <nav className="space-y-2">
                        <a href="#" className="block text-gray-700 hover:underline">Home</a>
                    </nav>
                </SideBar.Content>
            </SideBar>
        </div>
    );
};