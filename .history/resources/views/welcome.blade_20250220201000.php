import React, { useState } from "react";
import { Tabs, TabsList, TabsTrigger, TabsContent } from "@/components/ui/tabs";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

export default function AccidentReportForm() {
  const [activeTab, setActiveTab] = useState("login");

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <Card className="w-full max-w-md shadow-lg">
        <CardContent className="p-6">
          <Tabs value={activeTab} onValueChange={setActiveTab} className="w-full">
            <TabsList className="grid w-full grid-cols-2 bg-gray-200 rounded-lg mb-6">
              <TabsTrigger value="login" className="py-2 text-lg font-medium text-gray-700">
                Login
              </TabsTrigger>
              <TabsTrigger value="register" className="py-2 text-lg font-medium text-gray-700">
                Registro
              </TabsTrigger>
            </TabsList>
            <TabsContent value="login">
              <form className="space-y-4">
                <Input type="email" placeholder="Correo electrónico" className="w-full" />
                <Input type="password" placeholder="Contraseña" className="w-full" />
                <Button className="w-full bg-blue-600 text-white hover:bg-blue-700">
                  Iniciar Sesión
                </Button>
              </form>
            </TabsContent>
            <TabsContent value="register">
              <form className="space-y-4">
                <Input type="text" placeholder="Nombre completo" className="w-full" />
                <Input type="email" placeholder="Correo electrónico" className="w-full" />
                <Input type="password" placeholder="Contraseña" className="w-full" />
                <Button className="w-full bg-green-600 text-white hover:bg-green-700">
                  Registrarse
                </Button>
              </form>
            </TabsContent>
          </Tabs>
        </CardContent>
      </Card>
    </div>
  );
}
