import React from "react";
import PrimaryButton from "../../../Components/PrimaryButton";
import { useState } from "react";
import { motion, AnimatePresence } from "motion/react";
import ChipMotion from "../../../Components/Chip";
import Modal from "../../../Components/Modal";
import { Minimize2 } from "lucide-react";

const Filter = React.memo(function Filter({
    categoryData,
    selectedCategories,
    onSelectedCategoriesChange,
}) {
    const [isOpenModal, setIsOpenModal] = useState(false);

    const toggleModal = () => {
        setIsOpenModal((prev) => !prev);
    };
    return (
        <div className="flex flex-col gap-10">
            <motion.div
                layout
                transition={{
                    layout: {
                        type: "tween",

                        mass: 0.8,
                        duration: 0.5,
                    },
                }}
            >
                <AnimatePresence>
                    <motion.div
                        key={categoryData.id}
                        layout
                        initial={{ opacity: 0, scale: 0.8 }}
                        animate={{ opacity: 1, scale: 1 }}
                        exit={{ opacity: 0, scale: 0.8 }}
                        transition={{ duration: 0.3 }}
                        className="flex flex-wrap gap-2"
                    >
                        {categoryData.slice(0, 10).map((category) => (
                            <ChipMotion
                                layout
                                key={category.id}
                                category={category}
                                selected={selectedCategories.includes(
                                    category.id
                                )}
                                onSelectedCategoriesChange={
                                    onSelectedCategoriesChange
                                }
                            />
                        ))}
                    </motion.div>
                </AnimatePresence>
            </motion.div>
            {categoryData.length > 10 && (
                <PrimaryButton className="self-start" onClick={toggleModal}>
                    <p className="font-mer text-body">See All Categories</p>
                </PrimaryButton>
            )}
            <AnimatePresence>
                <Modal
                    open={isOpenModal}
                    setIsOpen={setIsOpenModal}
                    toggleOpen={toggleModal}
                >
                    <Modal.Content
                        initial={{ y: "100%", opacity: 0 }}
                        animate={{ y: 0, opacity: 1 }}
                        exit={{ y: "100%", opacity: 0 }}
                        className="w-full flex flex-col gap-5 p-5"
                    >
                        <div className="flex justify-between items-center mb-4">
                            <h2 className="font-mer text-h3 text-[--Pink-Primary]">
                                All Categories
                            </h2>
                            <button
                                className="close-cart"
                                onClick={toggleModal}
                            >
                                <Minimize2 />
                            </button>
                        </div>
                        <div className="flex flex-wrap gap-3 overflow-y-auto max-h-[65dvh]">
                            {categoryData.map((category) => (
                                <ChipMotion
                                    layout
                                    key={category.id}
                                    category={category}
                                    selected={selectedCategories.includes(
                                        category.id
                                    )}
                                    onSelectedCategoriesChange={
                                        onSelectedCategoriesChange
                                    }
                                />
                            ))}
                        </div>
                    </Modal.Content>
                </Modal>
            </AnimatePresence>
            {/* {visibleCount < categoryData.length && (
                <PrimaryButton
                    className="flex justify-center items-center"
                    onClick={handleLoadMore}
                >
                    <p className="font-mer text-body">Show More</p>
                </PrimaryButton>
            )}
            {visibleCount > 10 && (
                <PrimaryButton
                    className="flex justify-center items-center"
                    onClick={handleLoadLess}
                >
                    <p className="font-mer text-body">Show Less</p>
                </PrimaryButton>
            )} */}
        </div>
    );
});

export default Filter;
