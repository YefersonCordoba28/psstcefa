import React from "react";
import { Card, CardContent } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Carousel } from "@/components/ui/carousel";
import { Mail } from "lucide-react";

const InicioSST = () => {
  return (
    <div className="min-h-screen bg-white">
      <header className="bg-blue-800 text-white py-4 text-center text-3xl font-bold">
        Sistema de Gestión de Seguridad y Salud en el Trabajo
      </header>

      <main className="flex justify-center py-8">
        <Card className="w-3/4 shadow-2xl">
          <Carousel>
            <div className="flex items-center justify-between p-6">
              <div className="w-1/2">
                <h2 className="text-xl font-bold text-blue-800 mb-4">
                  El Ministerio de Ambiente y Desarrollo Sostenible certifica nuevamente sus Sistemas de Gestión en la vigencia 2022
                </h2>
                <ul className="list-disc pl-5 text-gray-700">
                  <li>Sistema de Gestión de Calidad - ISO 9001:2015</li>
                  <li>Sistema de Gestión Ambiental - ISO 14001:2015</li>
                </ul>
                <div className="flex gap-4 mt-4">
                  <img src="/icontec_iso9001.png" alt="ISO 9001" className="w-16 h-16" />
                  <img src="/icontec_iso14001.png" alt="ISO 14001" className="w-16 h-16" />
                  <img src="/iqnet.png" alt="IQNet" className="w-20 h-16" />
                </div>
              </div>

              <div className="w-1/2">
                <img src="/certificados_grupo.png" alt="Grupo Certificado" className="rounded-lg shadow-lg" />
              </div>
            </div>
          </Carousel>
        </Card>
      </main>

      <Button className="fixed bottom-6 right-6 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700">
        <Mail className="w-6 h-6" />
      </Button>
    </div>
  );
};

export default InicioSST;
