<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="conversao.aspx.cs" Inherits="WebApplication1.conversao" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Conversão</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>

        <asp:HyperLink ID="HyperLink1" runat="server" ImageHeight="40px" NavigateUrl="~/inicio.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/Home.png">Inicio</asp:HyperLink>
        &nbsp
        <asp:HyperLink ID="HyperLink2" runat="server" ImageHeight="40px" NavigateUrl="~/abastecer.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/07-postos_icon.png">Abastecer</asp:HyperLink>

        <br />
        <br />

        <asp:Label ID="lblInfo" runat="server" Text="1 dólar = 2,27 reais / 1 euro = 3,01 reais / 1 libra = 3,78 reais"></asp:Label>

        <br />
        <br />


        <asp:Label ID="lblValor" runat="server" Text="Informe o valor:"></asp:Label>
        &nbsp
        <asp:TextBox ID="tbValor" runat="server"></asp:TextBox>

        <br />
        <br />

        <asp:Label ID="lblTipoMoeda" runat="server" Text="Tipo de Moeda:"></asp:Label>
        &nbsp
        <asp:DropDownList ID="ddlTipoMoeda" runat="server">
            <asp:ListItem>Dólar</asp:ListItem>
            <asp:ListItem>Euro</asp:ListItem>
            <asp:ListItem>Libra</asp:ListItem>
        </asp:DropDownList>

        <br />
        <br />

        <asp:RadioButton ID="rbParaReal" runat="server" Text="Converter para Real" GroupName="rblOrdemConversão" />
        <br />
        <asp:RadioButton ID="rbRealPara" runat="server" Text="Converter para moeda estrangeira" GroupName="rblOrdemConversão" />
        <asp:RadioButtonList ID="rblOrdemConversão" runat="server"></asp:RadioButtonList>

        <br />
        <br />

        <asp:Button ID="btCalcular" runat="server" Text="Converter" OnClick="btCalcular_Click" />
        &nbsp
        <asp:Label ID="lblResultado" runat="server" Text="Resultado aqui..!!"></asp:Label>

    
    </div>
    </form>
</body>
</html>
